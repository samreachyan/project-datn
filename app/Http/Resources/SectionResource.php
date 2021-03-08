<?php

namespace App\Http\Resources;

use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lessons = Lesson::where('section_id', $this->id)->get();
        $quiz = Quiz::where('section_id', $this->id)->get();

        return [
            'id' => (string) $this->id,
            'title' => $this->name,
            'lessons' => LessonResource::collection($lessons),
            'quizzes' => QuizResource::collection($quiz),
        ];
    }
}
