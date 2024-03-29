<?php
class ScheduleMap extends BaseMap
{
    public function existsScheduleByLessonPlanId($idPlan)
    {
        $res = $this->db->query("SELECT schedule_id FROM schedule
        WHERE lesson_plan_id = $idPlan");
        if ($res->fetchColumn() > 0) {
            return true;
        }
        return false;
    }
    public function findDayById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT name FROM day
        WHERE day_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function existsScheduleTeacherAndGruppa($schedule = Schedule)
    {
        $plan = (new LessonPlanMap())->findById($schedule->lesson_plan_id);
        $res = $this->db->query("SELECT schedule.schedule_id FROM
        lesson_plan INNER JOIN schedule "
            . "ON
        lesson_plan.lesson_plan_id=schedule.lesson_plan_id "
            . "WHERE (lesson_plan.gruppa_id=$plan->gruppa_id OR lesson_plan.user_id=$plan->user_id) AND "
            . "(schedule.day_id=$schedule->day_id)");
        if ($res->fetchColumn() > 0) {
            return true;
        }
        return false;
    }
    public function save($schedule = Schedule)
    {
        if (
            $this->db->exec("INSERT INTO schedule(lesson_plan_id,
        day_id,  classroom_id)"
                . " VALUES($schedule->lesson_plan_id,$schedule->day_id,  $schedule->classroom_id)") == 1
        ) {
            return true;
        }
        return false;
    }
    public function findByTeacherId($id = null)
    {
        $days = $this->findDays();
        $result = [];
        foreach ($days as $day) {
            $arrDay = [];
            $arrDay['id'] = $day->day_id;
            $arrDay['name'] = $day->name;
            $arrDay['gruppa'] = [];
            $gruppas = $this->findGruppasByDayTeacher($id, $day->day_id);
            foreach ($gruppas as $gruppa) {
                $arrGruppa = [];
                $arrGruppa['name'] = $gruppa->name;
                $arrGruppa['schedule'] = $this->findByGruppasDayTeacher($id, $day->day_id, $gruppa->gruppa_id);
                $arrDay['gruppa'][] = $arrGruppa;
            }
            $result[] = $arrDay;
        }
        return $result;
    }

    public function findByStudentId($id = null)
    {
        $days = $this->findDays();
        $result = [];
        $gruppa = $this->findGruppaByStudentId($id);

        $result['gruppa'] = $gruppa['name'];

        foreach ($days as $day) {
            $arrDay = [];
            $arrDay['id'] = $day->day_id;
            $arrDay['name'] = $day->name;

            $arrDay['schedule'] = $this->findByGruppaDayStudent($day->day_id, $gruppa['gruppa_id']);

            $result['allSchedule'][] = $arrDay;
        }
        return $result;
    }

    public function findByGruppaDayStudent($dayId, $gruppaId)
    {
        $res = $this->db->query("SELECT
        schedule.schedule_id,subject.name AS subject, gruppa.name AS gruppa, classroom.name AS classroom FROM lesson_plan 
        INNER JOIN schedule ON
        lesson_plan.lesson_plan_id=schedule.lesson_plan_id INNER JOIN subject ON
        lesson_plan.subject_id=subject.subject_id  INNER JOIN gruppa ON gruppa.gruppa_id=lesson_plan.gruppa_id INNER JOIN classroom ON
        schedule.classroom_id=classroom.classroom_id 
        WHERE schedule.day_id=$dayId AND lesson_plan.gruppa_id = $gruppaId
        
        ");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findGruppaByStudentId($id)
    {
        $res = $this->db->query("SELECT gruppa.gruppa_id, gruppa.name 
            FROM student
            INNER JOIN gruppa ON student.gruppa_id = gruppa.gruppa_id
            WHERE student.user_id = $id ");
        return $res->fetch(PDO::FETCH_ASSOC);
    }



    public function findDays()
    {
        $res = $this->db->query("SELECT day_id, name FROM day");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    public function findGruppasByDayTeacher($teacherId, $dayId)
    {
        $res = $this->db->query("SELECT DISTINCT
        gruppa.gruppa_id, gruppa.name FROM lesson_plan "
            . "INNER JOIN schedule ON
        lesson_plan.lesson_plan_id=schedule.lesson_plan_id "
            . "INNER JOIN gruppa ON
        lesson_plan.gruppa_id=gruppa.gruppa_id "
            . "WHERE lesson_plan.user_id=$teacherId
        AND schedule.day_id=$dayId ORDER BY gruppa.name");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }



    public function findByGruppasDayTeacher($teacherId, $dayId, $gruppaId)
    {
        $res = $this->db->query(
            "SELECT
        schedule.schedule_id, CONCAT(special.time_begin, ' — ' ,special.time_end) as time, subject.name 
        AS subject,classroom.name AS
        classroom FROM lesson_plan INNER JOIN schedule ON
        lesson_plan.lesson_plan_id=schedule.lesson_plan_id INNER JOIN subject ON
        lesson_plan.subject_id=subject.subject_id INNER JOIN classroom ON
        schedule.classroom_id=classroom.classroom_id
        INNER JOIN special ON special.special_id = lesson_plan.subject_id
        WHERE lesson_plan.user_id=$teacherId AND
        schedule.day_id=$dayId AND
        lesson_plan.gruppa_id=$gruppaId"
        );
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }


    public function delete($id)
    {
        if (
            $this->db->exec("DELETE FROM schedule WHERE
        schedule_id=$id") == 1
        ) {
            return true;
        }
        return false;
    }
}
