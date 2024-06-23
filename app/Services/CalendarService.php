<?php

namespace App\Services;

use App\Lesson;

class CalendarService
{
    public function generateCalendarData($weekDays)
    {
        $calendarData = [];
        $timeRange = (new TimeService)->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        $lessons   = Lesson::with('class', 'teacher','subjects',)
            ->calendarByRoleOrClassId()
            ->get();
        foreach ($timeRange as $time)
        {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day)
            {
                $lesson = $lessons->where('weekday', $index)->where('start_time', $time['start'])->first();

              
                if ($lesson)
                {
                    array_push($calendarData[$timeText], [
                        'class_name'   => $lesson->class['name'] ?? '',
                        'teacher_name' => $lesson->teacher->name,
                        'subject_name' => $lesson->subjects['name'] ?? '',
                        'auditor'      => $lesson->audiences['name'] ?? '',
                        'facultet'     => $lesson->facultets->name,
                        'cours'        => $lesson->id_cours,
                        'rowspan'      => $lesson->difference/60 ?? ''
                    ]);
                }
                else if (!$lessons->where('weekday', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count())
                {
                    array_push($calendarData[$timeText], 1);
                }
                else
                {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }

        return $calendarData;
    }
}
