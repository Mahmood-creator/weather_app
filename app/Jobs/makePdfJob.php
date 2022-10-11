<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class makePdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $todos;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($todos)
    {
        $this->todos = $todos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pdf = \PDF::loadView('pdf.todo',['todos' => $this->todos])->download();
        Storage::put(('public/pdf/todo.pdf'),$pdf);
    }
}
