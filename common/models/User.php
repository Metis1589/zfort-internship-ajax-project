<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property integer $status
 * @property string $username
 * @property string $firstName
 * @property boolean $driver
 * @property string $lastName
 * @property string $authKey
 * @property string $password
 * @property string $resetToken
 * @property string $email
 * @property string $phone
 * @property string $skype
 * @property string $photo
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property Car $car
 * @property Skill $skill
 * @property Request[] $requests
 * @property Ride[] $rides
 * @property Schedule[] $schedules
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['driver', 'default', 'value' => false],
            [['status'], 'integer'],
            [['driver'], 'boolean'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DISABLED]],
            [['username', 'firstName', 'lastName', 'email'], 'required'],
            [['password'], 'required', 'when' => function($model){
                return $model->getIsNewRecord();
            }],
            [['username', 'firstName', 'lastName', 'email'], 'string', 'max' => 128],
            [['authKey'], 'string', 'max' => 32],
            [['password', 'resetToken'], 'string', 'max' => 255],
            [['photo'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 15],
            [['skype'], 'string', 'max' => 64],
            [['username', 'email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'username' => Yii::t('app', 'Username'),
            'firstName' => Yii::t('app', 'First Name'),
            'lastName' => Yii::t('app', 'Last Name'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'password' => Yii::t('app', 'Password'),
            'resetToken' => Yii::t('app', 'Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'skype' => Yii::t('app', 'Skype'),
            'photo' => Yii::t('app', 'Photo'),
            'createdAt' => Yii::t('app', 'Created Date'),
            'updatedAt' => Yii::t('app', 'Updated Date'),
            'deletedAt' => Yii::t('app', 'Deleted Date'),
        ];
    }

    /**
     * @inheritdoc
     * @return array
     */
    public function fields()
    {
        $data = parent::fields();
        unset($data['password']);
        unset($data['resetToken']);
        unset($data['authKey']);
        return $data;
    }

    /**
     * @inheritdoc
     * @param boolean $insert
     */
    public function beforeSave($insert)
    {
        if ($insert || $this->isAttributeChanged('password')) {
            $this->setPassword($this->password);
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['authKey' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                'resetToken' => $token,
                'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->resetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->resetToken = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['userId' => 'id'])->inverseOf('user');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['userId' => 'id'])->inverseOf('user');
    }

    /**
     * @return query\RequestQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['userId' => 'id'])->inverseOf('user');
    }

    /**
     * @return query\RideQuery
     */
    public function getRides()
    {
        return $this->hasMany(Ride::className(), ['userId' => 'id'])->inverseOf('user');
    }

    /**
     * @return query\ScheduleQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['userId' => 'id'])->inverseOf('user');
    }

}
