namespace App\Models;

trait HasAttachments
{
    public function syncAttachmentsMeta()
    {
        $this->content->attachments()
            ->filter(fn ($attachment) => $attachment->attachable instanceof Attachment)
            ->each(function ($attachment) {
                $attachment->attachable->update([
                    'record' => $this,
                    'caption' => $attachment->node->getAttribute('caption'),
                ]);
             });
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'record');
    }
}
