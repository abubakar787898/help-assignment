<?php

namespace App\Helpers;

use Illuminate\Validation\Rule;
use App\Helpers\HelperMessage;
use App\Models\Activity;
use App\Models\BuddyGroup;
use App\Models\BuddyGroupChat;
use App\Models\BuddyGroupUser;
use App\Models\BuddyGroupUserInvitation;
use App\Models\Company;
use App\Models\DeviceInfo;
use App\Models\Engagement;
use App\Models\EngagementAnswer;
use App\Models\EngagementQuestionOptionAnswer;
use App\Models\NewsFeed;
use App\Models\UserActivity;
use App\Models\UserTopicExercise;
use App\Models\OneSignalPushNotification;
use App\Models\TopicExercise;
use App\Models\User;
use App\Models\UserLearningJourney;
use App\Models\UserPersonalDiary;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Support\Carbon;
use Log;
use Str;

class Helper
{

    /**
     * used for json to send Response
     */
    public static function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public static function sendTestErrorResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 400);
    }

    /**
     * used for json to send Error response
     */
    public static function sendError($error, $errorMessages = [], $code = 404)
    {

        $response = [
            'success' => false,
            'message' => $error,
            'status' => $code,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * get month and year as intenger and
     * return array of startDay and EndDate carbon object
     *
     * @param [integer] $month 1..12
     * @param [ineger] $year 4 digit number
     * @return array(CarbonDate object, Carbon date object)
     */
    public static function getStartEndTimeObject($month, $year)
    {

        $startDate = Carbon::now();

        // Set charge_date month start of month and end of month
        $startDate->setMonth($month)->setYear($year)->setDay(1)->startOfDay();

        $endDate = $startDate->copy();
        $endDate->endOfMonth()->endOfDay();

        return array($startDate->copy(), $endDate->copy());
    }

    /**
     * retuirn laravel response->json to array
     *
     * @param [type] $response
     * @return void
     */
    public static function jsonResponseToArray($response)
    {

        return json_decode($response->content(), true);
    }


    /**
     * used for json to send Response
     */
    public static function getPrice($price)
    {

        return $price . ' Kr.';
    }

    public static function validateNameLanguages($language)
    {
        if (!is_array($language->name)) {

            $language->name = json_decode($language->name, true);
        }

        return [
            'name' => Rule::requiredIf(
                $language->name['en'] == null
                    && $language->name['dk'] == null
            )
        ];
    }

    public static function validateDescriptionLanguages($language)
    {
        return ['description' => Rule::requiredIf(
            $language->description['en'] == null
                && $language->description['dk'] == null
        )];
    }

    public static function ConvertJsonNullToEmptyString($jsonObj)
    {
        //return ($jsonObj);
        if (!is_array($jsonObj)) {

            $jsonObj = json_decode($jsonObj, true);
        }

        foreach ($jsonObj as &$val) {
            if ($val === null)
                $val = '';
        }
        unset($val);
        return $jsonObj;
    }

    public static function isTopicActive($topic, $userId)
    {
        return 1;
    }

    public static function getNextActivity($activityId, $user_id)
    {

        // $userActivity = UserActivity::where('activity_id', $activityId)
        //     ->with('activity.learning_journey')
        //     ->where('user_id', $user_id)
        //     ->first();

        $activity = Activity::with('learning_journey')->find($activityId);



        // if ($userActivity) {

        //     $learning_journey_id = $userActivity?->activity?->learning_journey_id;

        //     $userNextActivities = Activity::
        //         whereHas('learning_journey', function ($query) use ($learning_journey_id) {
        //             $query->where('learning_journey_id', $learning_journey_id);
        //         })
        //         // ->with('userActivities', function ($query) use ($user_id) {
        //         //     $query->where('user_id', $user_id);
        //         //     // ->whereNotIn('status', ['current', 'complete']);
        //         // })
        //         ->where('order', '>=', $userActivity?->activity->order)
        //         // ->whereNot('id', $userActivity?->activity_id)
        //         ->orderBy('order')
        //         ->get();

        //     $nextOne=null;

        //     $find=false;
        //     foreach($userNextActivities as $userNextActivity){

        //         if($find) {
        //         $nextOne=$userNextActivity;
        //         break;
        //         }

        //         if($userNextActivity?->id == $userActivity?->activity_id) {
        //         $find=true;
        //         }
        //     }

        // } else {



        // }

        $learning_journey_id = $activity?->learning_journey_id;


        $activities = Activity::whereHas('learning_journey', function ($query) use ($learning_journey_id) {
            $query->where('learning_journey_id', $learning_journey_id);
        })
            // ->with('userActivities', function ($query) use ($user_id) {
            //     $query->where('user_id', $user_id);
            //     // ->whereNotIn('status', ['current', 'complete']);
            // })
            // ->where('order', '>=', $activity->order)
            // ->whereNot('id', $userActivity?->activity_id)
            ->orderBy('order')
            ->get();


        // $subset = $activities->skipUntil(function ($item) use($activityId) {
        //     return $item->id = $activityId;
        // });

        // $subset = $activities->slice(function ($item) use($activityId) {
        //     return $item->id = $activityId;
        // });

        $find = false;
        $nextOne = null;

        $multiplied = $activities->map(function ($item, $key) use ($find, $activityId, $nextOne) {

            if ($find) {
                $nextOne = $item;
                $find = false;
            }

            if ($activityId == $item?->id) {
                $find = true;
            }
        });

        // $subset->all();

        return $nextOne;
    }

    public  static function convertToDropDownObject($array)
    {

        $associateArray = [];
        foreach ($array as $key => $element) {

            $associateArray[] = [
                'id' => $element,
                'name' => $key,
            ];
        }

        return $associateArray;
    }

    public  static function getHighestOrderNumber($object, $column_name, $column_value, $order_column)
    {
        $highestOrder = $object::where($column_name, $column_value)
            ->orderBy($order_column, 'desc')
            ->value($order_column);

        return $highestOrder;
    }

    /**
     * notification_infos object should be like
     *
     * "notification_info": {
                "user_id": 1,
                "company_id": 22,
                "device_name": "Samsung",
                "device_id": "abcdef-12345-6789-9876-qwer8675",
                "notification_datetime": "2023-08-10 01:00:00"
                exercise_obj :{}
            }
     */

    // public static function setAllUsersDailyExerciseRepeatPushNotifications()
    // {
    //     $currentDate = now();

    //     $userIdsWithStartedStatus = UserTopicExercise::where('status', 'started')
    //         ->whereDate('end_date', '>=', $currentDate->toDateString())
    //         ->pluck('user_id')
    //         ->toArray();

    //     $deviceInfos = DeviceInfo::whereHas('userTopicExercises', function ($query) use ($currentDate) {
    //         $query->whereDate('end_date', '>=', $currentDate->toDateString())
    //             ->where('status', 'started');
    //     })
    //         ->with(['userTopicExercises' => function ($query) use ($currentDate) {
    //             $query->whereDate('end_date', '>=', $currentDate->toDateString())
    //                 ->where('status', 'started');
    //         }])
    //         ->get();

    //     // $deviceInfos = DeviceInfo::whereHasAndWith('userTopicExercises', function ($query) use ($currentDate) {
    //     //     $query->whereDate('end_date', '>=', $currentDate->toDateString())
    //     //         ->where('status', 'started');
    //     // })
    //     // ->get();

    //     $deviceInfoByUser = $deviceInfos->groupBy('user_id');

    //     $device_informations = collect($userIdsWithStartedStatus)->flatMap(function ($userId) use ($deviceInfoByUser) {
    //         return $deviceInfoByUser->get($userId, []);
    //     })->map(function ($deviceInfo) {
    //         $userTopicExercises = collect($deviceInfo['user_topic_exercises'])->first();
    //         $deviceInfo['user_topic_exercises'] = $userTopicExercises;
    //         return $deviceInfo;
    //     });

    //     $finalDeviceInfos = $device_informations->map(function ($deviceInfo) {
    //         if (isset($deviceInfo['user_topic_exercises']) && !empty($deviceInfo['user_topic_exercises'])) {
    //             $userTopicExercises = $deviceInfo['user_topic_exercises'];
    //             unset($deviceInfo['user_topic_exercises']);
    //             $deviceInfo['user_topic_exercises'] = $userTopicExercises[0];
    //         }
    //         return $deviceInfo;
    //     });

    //     $notification_infos = collect();

    //     foreach ($finalDeviceInfos as $deviceInfo) {

    //         foreach ($deviceInfo['userTopicExercises'] as $exercise) {
    //             $notificationTime = Carbon::parse($exercise['notification_time']);
    //             $notification_date = $currentDate->format('Y-m-d') . ' ' . $notificationTime->format('H:i:s');

    //             $type_name = TopicExercise::find($exercise['exercise_id'])->name;

    //             $newItem = collect([
    //                 'user_id' => $deviceInfo->user_id,
    //                 'company_id' => $deviceInfo->company_id,
    //                 'type_id' => $exercise['exercise_id'],
    //                 'type_name_en' => $type_name,
    //                 'type_name_dk' => $type_name,
    //                 'type' => OneSignalPushNotification::TYPE_EXERCISE_REPEAT,
    //                 'device_name' => $deviceInfo->device_name,
    //                 'device_id' => $deviceInfo->device_id,
    //                 'device_info_id' => $deviceInfo->id,
    //                 'notification_datetime' => $notification_date,
    //                 'data' => []
    //             ]);
    //             $notification_infos->push($newItem);
    //         }
    //     }

    //     $notification_infos = $notification_infos->unique(function ($item) {
    //         return $item['user_id'] . $item['company_id'] . $item['device_id'] . $item['notification_datetime'];
    //     })->toArray();

    //     $push_notifications = [];

    //     foreach ($notification_infos as $notification_info) {

    //         $notification_info = (object)$notification_info;

    //         $schedule_notification = PushNotification::schedulePushNotification($notification_info);

    //         if (isset($schedule_notification['id']) && !isset($schedule_notification['errors'])) {
    //             $push_notifications[] = [
    //                 'notification_id' => $schedule_notification['id'],
    //                 'user_id' => $notification_info->user_id,
    //                 'company_id' => $notification_info->company_id,
    //                 'device_info_id' => $notification_info->device_info_id,
    //                 'type' => OneSignalPushNotification::TYPE_EXERCISE_REPEAT,
    //                 'type_id' => $notification_info->type_id,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ];

    //             Log::alert([
    //                 'Successfully Notification sent to user_id' => $notification_info?->user_id,
    //                 'user_id' =>  $notification_info?->user_id,
    //                 'company_id' => $notification_info?->company_id,
    //                 'device_id' => $notification_info?->device_id,
    //                 'device_info_id' => $notification_info?->device_info_id,
    //                 'type' => OneSignalPushNotification::TYPE_EXERCISE_REPEAT,
    //                 'type_id' => $notification_info?->type_id,
    //                 'type_name_en' => $notification_info?->type_name_en,
    //                 'notification_datetime' => $notification_info?->notification_datetime,
    //             ]);
    //         } else if (isset($schedule_notification['errors'])) {

    //             Log::alert([
    //                 'Error' => $schedule_notification['errors'],
    //                 'user_id' => $notification_info?->user_id,
    //                 'company_id' => $notification_info?->company_id,
    //                 'device_id' => $notification_info?->device_id,
    //                 'device_info_id' => $notification_info?->device_info_id,
    //                 'type' => OneSignalPushNotification::TYPE_EXERCISE_REPEAT,
    //                 'type_id' => $notification_info?->type_id,
    //                 'type_name_en' => $notification_info?->type_name_en,
    //                 'notification_datetime' => $notification_info?->notification_datetime,
    //             ]);
    //         }
    //     }

    //     if (count($push_notifications) > 0) {
    //         OneSignalPushNotification::insert($push_notifications);
    //     }

    //     return Helper::sendResponse(['push_notification' => $push_notifications], HelperMessage::send("Notification "));
    // }


    public static function setUserDailyExerciseRepeatPushNotification($user, $exercise_id)
    {

        $currentDate = now();

        // $userIdsWithStartedStatus = UserTopicExercise::where('status', 'started')
        //     ->whereDate('end_date', '>=', $currentDate->toDateString())
        //     ->pluck('user_id')
        //     ->toArray();

        $deviceInfos = DeviceInfo::with(['userTopicExercises' => function ($query) use ($currentDate, $exercise_id) {
            $query->whereDate('end_date', '>=', $currentDate->toDateString());
            $query->where('exercise_id', $exercise_id);
        }])
            ->where('user_id', $user->id)
            ->get();

        $deviceInfoByUser = $deviceInfos->groupBy('user_id');

        $device_informations = collect($user->id)->flatMap(function ($userId) use ($deviceInfoByUser) {
            return $deviceInfoByUser->get($userId, []);
        })->map(function ($deviceInfo) {
            $userTopicExercises = collect($deviceInfo['user_topic_exercises'])->first();
            $deviceInfo['user_topic_exercises'] = $userTopicExercises;
            return $deviceInfo;
        });

        $finalDeviceInfos = $device_informations->map(function ($deviceInfo) {
            if (isset($deviceInfo['user_topic_exercises']) && !empty($deviceInfo['user_topic_exercises'])) {
                $userTopicExercises = $deviceInfo['user_topic_exercises'];
                unset($deviceInfo['user_topic_exercises']);
                $deviceInfo['user_topic_exercises'] = $userTopicExercises[0];
            }
            return $deviceInfo;
        });

        $notification_infos = collect();

        foreach ($finalDeviceInfos as $deviceInfo) {

            foreach ($deviceInfo['userTopicExercises'] as $exercise) {
                $notificationTime = Carbon::parse($exercise['notification_time']);
                $notification_date = $currentDate->format('Y-m-d') . ' ' . $notificationTime->format('H:i:s');

                $type_name = TopicExercise::find($exercise['exercise_id'])->name;

                $newItem = collect([
                    'message' => "Det er tid til  " . $type_name,
                    'user_id' => $deviceInfo->user_id,
                    'company_id' => $deviceInfo->company_id,
                    'type_id' => $exercise['exercise_id'],
                    'type_name_en' => $type_name,
                    'type_name_dk' => $type_name,
                    'type' => OneSignalPushNotification::TYPE_EXERCISE_REPEAT,
                    'device_name' => $deviceInfo->device_name,
                    'device_id' => $deviceInfo->device_id,
                    'device_info_id' => $deviceInfo->id,
                    'notification_datetime' => $notification_date,
                    'data' => []
                ]);
                $notification_infos->push($newItem);
            }
        }

        $notification_infos = $notification_infos->unique(function ($item) {
            return $item['user_id'] . $item['company_id'] . $item['device_id'] . $item['notification_datetime'];
        })->toArray();

        $push_notifications = [];

        foreach ($notification_infos as $notification_info) {

            $notification_info = (object)$notification_info;

            $schedule_notification = PushNotification::schedulePushNotification($notification_info);

            // Log::info(
            //     'user_id: ' . $notification_info->user_id . ' ____ '
            //         . 'device_id: ' . $notification_info->device_id . ' ____ '
            //         . 'exercise_id: ' . $notification_info->type_id . ' ____ '
            //         . 'schedule_notification: ',
            //     $schedule_notification
            // );

            if (isset($schedule_notification['id']) && !isset($schedule_notification['errors'])) {
                $push_notifications[] = [
                    'notification_id' => $schedule_notification['id'],
                    'user_id' => $notification_info?->user_id,
                    'company_id' => $notification_info?->company_id,
                    'device_info_id' => $notification_info?->device_info_id,
                    'type' => OneSignalPushNotification::TYPE_EXERCISE_REPEAT,
                    'type_id' => $notification_info?->type_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (count($push_notifications) > 0) {
            OneSignalPushNotification::insert($push_notifications);
        }

        return Helper::sendResponse(['push_notification' => $push_notifications], HelperMessage::send("Notification "));
    }

    static function deletePersonalDiaryRelevantEngagementAnswers($user, $learning_journey_id, $is_stop_learning_journey)
    {

        $activityIds = Activity::where('learning_journey_id', $learning_journey_id)->pluck('id')->toArray();
        $activityEngamentIds = Engagement::whereIn('activity_id', $activityIds)->pluck('id')->toArray();

        $engagementAnswerIds = EngagementAnswer::whereIn('engagement_id', $activityEngamentIds)
            ->where('user_id', $user->id)
            ->pluck('id')
            ->toArray();

        if ($is_stop_learning_journey) {

            UserPersonalDiary::where('user_id', $user->id)
                ->where('type', UserPersonalDiary::$TYPE_ENGAMENT_ANSWER)
                ->whereIn('type_id', $engagementAnswerIds)
                ->forceDelete();

            EngagementAnswer::whereIn('engagement_id', $activityEngamentIds)
                ->where('user_id', $user?->id)
                ->forceDelete();

            EngagementQuestionOptionAnswer::whereIn('engagement_id', $activityEngamentIds)
                ->where('user_id', $user?->id)
                ->forceDelete();
        } else {

            UserPersonalDiary::where('user_id', $user->id)
                ->where('type', UserPersonalDiary::$TYPE_ENGAMENT_ANSWER)
                ->whereIn('type_id', $engagementAnswerIds)
                ->delete();

            EngagementAnswer::whereIn('engagement_id', $activityEngamentIds)
                ->where('user_id', $user?->id)
                ->delete();

            EngagementQuestionOptionAnswer::whereIn('engagement_id', $activityEngamentIds)
                ->where('user_id', $user?->id)
                ->delete();
        }

        // self::DeleteAllUserActivities($user, $activityIds);

        return true;
    }

    /**
     * delete Personal diary releavnt to those engamgnets answers
     * and delete engagenmt answers data
     */
    static function deleteUserDiaryWithEngamgentAnswers($user, $learning_journey_id, $is_stop_learning_journey = false)
    {

        self::deletePersonalDiaryRelevantEngagementAnswers($user, $learning_journey_id, $is_stop_learning_journey);
        
        self::deleteUserLearningJourneyActivities($user?->id, $learning_journey_id);

        // Always call in last
        //self::deleteUserActivities($user, $learning_journey_id, $is_stop_learning_journey);

        return true;
    }

    /**
     * delete all invitation of current user
     * and delete also group users
     */
    public static function deleteInvitationAndGroupUser($user, $learning_journey_id)
    {
        // $userLearningJourneysIds = UserLearningJourney::where([
        //     'learning_journey_id' => $learning_journey_id,
        //     'user_id' => $user?->id,
        // ])
        //     ->where('status', UserLearningJourney::STATUS_STOPPED)
        //     ->withTrashed()
        //     ->pluck('id')
        //     ->toArray();

        // dd($userLearningJourneysIds);

        // //getting droup ids of current user from the group of specific UserLearningJourney
        // $buddyGroupUserIds = BuddyGroupUser::whereIn('user_learning_journey_id', $userLearningJourneysIds)
        //     ->where('user_id', $user?->id)
        //     ->pluck('group_id')
        //     ->toArray();

        // //getting and deleteing all the group invitation send to and receive by current user
        // $buddyGroupUserInvitationIds = BuddyGroupUserInvitation::whereIn('buddy_group_id', $buddyGroupUserIds)
        //     ->where('learning_journey_id', $learning_journey_id)
        //     ->where(function ($query) use ($user) {
        //         $query->where('from_user_id', $user->id)
        //             ->orWhere('to_user_id', $user->id);
        //     })
        //     ->pluck('id')
        //     ->toArray();
        // BuddyGroupUserInvitation::whereIn('id', $buddyGroupUserInvitationIds)->delete();
    }

    public static function deleteBuddyGroupInvitaionsAndNewsFeed($user, $learning_journey_id)
    {

        $buddyGroupUserInvitations = BuddyGroupUserInvitation::where('learning_journey_id', $learning_journey_id)
            ->where('status', BuddyGroupUserInvitation::STATUS_ACCEPTED)
            ->where(function ($query) use ($user) {
                        $query->where('from_user_id', $user->id)
                            ->orWhere('to_user_id', $user->id);
                    })
            ->delete();

        $buddyGroupUserInvitationIds = BuddyGroupUserInvitation::where('learning_journey_id', $learning_journey_id)
            ->where('status', BuddyGroupUserInvitation::STATUS_WAITING)
            ->where('from_user_id', $user?->id)
            ->pluck('id')
            ->toArray();

        // get all pending inivitations on that learning journey and delete it
        BuddyGroupUserInvitation::whereIn('id', $buddyGroupUserInvitationIds)->delete();

        self::updateDeleteInvitationNewsFeeds($user, $buddyGroupUserInvitationIds);

        // // //English
        // // $title = "Buddy invite expired!";
        // // $detail = "It seems [user name] is done with the journey.";

        // //Danish
        // $title = "Invitation udløbet!";
        // $detail = "Det ser ud til [user name] er færdig med rejsen.";
        // $detail = Str::replace('[user name]', $user?->name, $detail);

        // // and update all relevant news feed content
        // $newsFeeds = NewsFeed::where([
        //     'from_user_id' => $user?->id,
        //     'type' => NewsFeed::TYPE_BUDDY_REQUEST
        // ])
        //     ->whereIn('type_id', $buddyGroupUserInvitationIds)
        //     ->get();

        // foreach ($newsFeeds as $newsFeed) {

        //     $newsFeed->title = $title;
        //     $newsFeed->detail = $detail;
        //     // to update updated_at
        //     $newsFeed->touch();
        //     $newsFeed->save();
        // }
    }

    public static function updateDeleteInvitationNewsFeeds($user, $buddyGroupUserInvitationIds)
    {
        // //English
        // $title = "Buddy invite expired!";
        // $detail = "It seems [user name] is done with the journey.";

        //Danish
        $title = "Invitation udløbet!";
        $detail = "Det ser ud til [user name] er færdig med rejsen.";
        $detail = Str::replace('[user name]', $user?->name, $detail);

        // and update all relevant news feed content
        $newsFeeds = NewsFeed::where([
            'from_user_id' => $user?->id,
            'type' => NewsFeed::TYPE_BUDDY_REQUEST
        ])
            ->whereIn('type_id', $buddyGroupUserInvitationIds)
            ->get();

        foreach ($newsFeeds as $newsFeed) {

            $newsFeed->title = $title;
            $newsFeed->detail = $detail;
            // to update updated_at
            $newsFeed->touch();
            $newsFeed->save();
        }
    }

    public static function kickOutBuddyGroup($user, $learning_journey_id)
    {

        $user_id = $user?->id;

        $buddyGroup = BuddyGroup::withWhereHas('buddyGroupUsers', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
            ->where('learning_journey_id', $learning_journey_id)
            ->first();

        if ($buddyGroup) {

            // Kick out from buddy group
            BuddyGroupUser::where('group_id', $buddyGroup->id)
                ->where('user_id', $user_id)
                ->delete();
        }
    }

    public static function kickOutBuddyGroupAndDeleteChat($user, $learning_journey_id)
    {

        $user_id = $user?->id;

        $buddyGroup = BuddyGroup::withWhereHas('buddyGroupUsers', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
            ->where('learning_journey_id', $learning_journey_id)
            ->first();

        if ($buddyGroup) {

            // Delete chat of that user from that group
            BuddyGroupChat::where('buddy_group_id', $buddyGroup->id)
                ->where('user_id', $user_id)
                ->delete();

            // Kick out permanently from buddy group
            BuddyGroupUser::where('group_id', $buddyGroup->id)
                ->where('user_id', $user_id)
                ->forceDelete();
        }
    }


    public static function deleteUserLearningJourneyActivities($user_id, $learning_journey_id)
    {

        $activityIds = Activity::where('learning_journey_id', $learning_journey_id)->pluck('id')->toArray();

        // Log::debug('actiovities deleted');
        // Log::debug($activityIds);

        UserActivity::whereIn('activity_id', $activityIds)
            ->where('user_id', $user_id)
            ->delete();
    }

    // public static function DeleteAllUserActivities($user, $activityIds)
    // {
    //     UserActivity::whereIn('activity_id', $activityIds)
    //         ->where('user_id', $user?->id)
    //         ->delete();
    // }

    public static function DeleteAllUserJourneyRelationalData($user, $learning_journey_id)
    {

        // self::deleteUserActivitiesAndEngagementsAnswers($user, $learning_journey_id);

        //GET ALL THE BuddyGroupUserInvitation STATUS ACCEPTED AND WAITING OF CURRENT USER
        $buddyGroupUserInvitations = BuddyGroupUserInvitation::where('learning_journey_id', $learning_journey_id)
            ->where(function ($query) {
                $query->where('status', BuddyGroupUserInvitation::STATUS_ACCEPTED)
                    ->orWhere('status', BuddyGroupUserInvitation::STATUS_WAITING);
            })
            ->where(function ($query) use ($user) {
                $query->where('from_user_id', $user?->id)
                    ->orWhere('to_user_id', $user?->id);
            })
            ->get();

        //GET & DELETE BuddyGroupUser OF CURRENT USER
        $buddyGroupids = $buddyGroupUserInvitations
            ->where('status', BuddyGroupUserInvitation::STATUS_ACCEPTED)
            ->pluck('buddy_group_id')
            ->unique();
        BuddyGroupUser::whereIn('group_id', $buddyGroupids)
            ->where('user_id', $user?->id)
            ->delete();

        //GET & REJECTED THE STATUS ACCEPTED OF BuddyGroupUserInvitation, WHICH INVITATION IS ACCEPTED OF CURRENT USER
        $buddyGroupUserInvitationids = $buddyGroupUserInvitations
            ->where('status', BuddyGroupUserInvitation::STATUS_ACCEPTED)
            ->pluck('id')
            ->unique();
        BuddyGroupUserInvitation::whereIn('id', $buddyGroupUserInvitationids)
            ->update(['status' => BuddyGroupUserInvitation::STATUS_REJECTED]);

        //GET & REJECTED THE STATUS WAITING OF BuddyGroupUserInvitation, WHICH INVITATIONS SENT BY CURRENT USER
        $buddyGroupUserInvitationids = $buddyGroupUserInvitations
            ->where('status', BuddyGroupUserInvitation::STATUS_WAITING)
            ->where('from_user_id', $user?->id)
            ->pluck('id')
            ->unique();
        BuddyGroupUserInvitation::whereIn('id', $buddyGroupUserInvitationids)
            ->update(['status' => BuddyGroupUserInvitation::STATUS_REJECTED]);

        $bGUserInvitations = $buddyGroupUserInvitations
            ->whereIn('id', $buddyGroupUserInvitationids);

        // //English
        // $title = "Buddy invite expired!";
        // $detail = "It seems [user name] is done with the journey.";

        //Danish
        $title = "Invitation udløbet!";
        $detail = "Det ser ud til [user name] er færdig med rejsen.";
        $detail = Str::replace('[user name]', $user?->name, $detail);

        foreach ($bGUserInvitations as $bGUserInvitation) {
            $newsFeed = NewsFeed::updateOrCreate(
                [
                    'user_id' => $bGUserInvitation?->to_user_id,
                    'from_user_id' => $user?->id,
                    'type_id' => $bGUserInvitation?->id,
                    'type' => NewsFeed::TYPE_BUDDY_REQUEST,
                ],
                [
                    'title' => $title,
                    'user_id' => $bGUserInvitation?->to_user_id,
                    'from_user_id' => $user?->id,
                    'type_id' => $bGUserInvitation?->id,
                    'type' => NewsFeed::TYPE_BUDDY_REQUEST,
                    'navigate_to' => '',
                    'detail' => $detail,
                    'company_id' => null,
                ]
            );
        }
    }


    /**
     * delete Data exercie engagment answers of given exercise of that user
     */
    // REMOVE ENGAGMENT ANSWERS IF ITS NOT TODAY AND PREVIOUS DAYS
    public static function removePreviousDateExerciseEngagementAnswers($exercise, $notification_time)
    {

        foreach ($exercise?->engagements as $engagement) {

            if ($engagement?->answer?->created_at?->format('Y-m-d') < Carbon::now()->format('Y-m-d')) {

                date_default_timezone_set(config('app.onesignal_timezone'));

                if ($notification_time <= Carbon::now()->format('H:i:s')) {

                    $engagement?->answer?->delete();
                }
            }
        }
    }

    // public function createNewsFeed(Type $var = null)
    // {

    //     NewsFeed::create([
    //         'title' => $event->title,
    //         'type_id' => $event->type_id,
    //         'type' => $event->type,
    //         'detail' => 'Click here to start',
    //         'company_id' => null,
    //         'user_id' => $event->userId,
    //     ]);

    // }
}
