<?php

namespace AppBundle\Event\Listener;

use AppBundle\Event\StudentEvent;
use Hip\MandrillBundle\Dispatcher;
use Hip\MandrillBundle\Message;

class StudentListener
{
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function edit(StudentEvent $event)
    {
        $student = $event->getStudent();

        if ($event->getType() == 'create') {
            $subject = 'Your account has been created!';
        } else {
            $subject = 'Your account has been edited!';
        }

        $html = '<html><body>Name: ' . $student->getName() . '<br/>Birthday: ' . $student->getBirthday()->format('Y-m-d') . '</body></html>';
        // ...

        $message = new Message();

        $message
            ->addTo($student->getEmail())
            ->setSubject($subject)
            ->setHtml($html);

        $this->dispatcher->send($message);
    }
}
