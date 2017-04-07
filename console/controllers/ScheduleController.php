<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace console\controllers;

use common\models\Schedule;
use common\models\Ride;
use Yii;
use yii\console\Controller;

/**
 * This command creates rides according to the schedule.
 *
 * @author Morozov Dmitry <morosovdmitry@gmail.com>
 */
class ScheduleController extends Controller
{
    /**
     * Creates rides according to the schedule.
     */
    public function actionIndex()
    {
        $dateString = date('Y-m-d');
        $scheduledRides = Schedule::find()->dayOfWeek(date('N'))->asArray()->all();
        foreach($scheduledRides as $scheduledRideArr){
            $ride = new Ride;
            $ride->attributes = $scheduledRideArr;
            $ride->from = $dateString. ' ' . $scheduledRideArr['from'];
            $ride->to = $dateString. ' ' . $scheduledRideArr['to'];
            $ride->save();
        }
    }
}
