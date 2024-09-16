<?php

namespace ClockInTime\Modules\Attendance\Notifications;

use ClockInTime\Modules\Attendance\Data\AttendanceRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class AttendanceCheckInConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly AttendanceRecord $attendance
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Attendance Check-In Confirmed: Thank You!')
            ->greeting("Dear $notifiable->name,")
            ->line(new HtmlString("We're happy to inform you that your attendance check-in has been <b>successfully</b> recorded for today!"))
            ->line(new HtmlString("Your check-in has been recorded at <b>{$this->attendance->check_in_time->format('H:i')}</b>."))
            ->line('Have a great day!')
            ->action('View Attendance', route('records:index'))
            ->line(new HtmlString('If you need to make any updates or have any questions, feel free to reach out to us at <a href="mailto:support@clockintime.com">support@clockintime.com</a>.'))
            ->salutation(new HtmlString('Best Regards,<br>'.config('app.name')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user' => $notifiable,
            'attendance' => $this->attendance,
        ];
    }
}
