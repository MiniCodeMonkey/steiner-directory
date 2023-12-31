<?php

namespace App\Http\Controllers;

use App\Models\MessageList;
use App\Models\Message;
use App\Models\Subscriber;
use App\Jobs\SendMessageJob;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function __invoke(Request $request) {
        $phone = $request->input('From');
        $message = trim($request->input('Body'));

        $list = MessageList::where('phone_owner', $phone)->first();

        if ($list) {
            info(print_r($request->all(), true));
            return $this->handleListPublish($list, $message);
        }

        $subscriber = Subscriber::where('phone', $phone)->first();
        if ($subscriber) {
            return $this->handleExistingSubscriber($subscriber, $phone, $message);
        } else {
            return $this->handleNewSubscriber($phone, $message);
        }
    }

    private function handleListPublish(MessageList $list, string $body)
    {
        info('Publish ' . $body . ' to ' . $list->name);

        $message = new Message();
        $message->phone_from = $list->phone_owner;
        $message->message = $body;
        $list->messages()->save($message);

        $message->send();

        return 'OK';
    }

    private function handleExistingSubscriber(Subscriber $subscriber, string $phone, string $message)
    {
        $message = strtolower($message);

        if (str_contains($message, 'afmeld') || str_contains($message, 'stop')) {
            $subscriber->delete();
            $this->sendMessage($phone, 'Du er blevet afmeldt fra listen.');
        } else {
            $this->sendMessage($phone, 'Du er i øjeblikket på listen. Svar "afmeld" hvis du ikke længere vil være på listen. Hvis du vil svare på en besked skal du skrive direkte til Tulle.');
        }

        return 'OK';
    }

    private function handleNewSubscriber(string $phone, string $message)
    {
        $cacheKey = 'signup:' . $phone;
        $session = cache()->get($cacheKey, []);

        if (str_contains(strtolower($message), 'tilmeld')) {
            cache()->put($cacheKey, ['name_requested' => true]);
            return $this->sendMessage($phone, 'For at komme med på listen skal vi lige bruge dit navn. Hvad hedder du?');
        }

        if (isset($session['name_requested']) && !isset($session['name'])) {
            if (strlen($message) >= 2) {
                $session['name'] = $message;
                cache()->put($cacheKey, $session);

                $name = explode(' ', $message)[0] ?? null;

                return $this->sendMessage($phone, 'Tak ' . $name . '! Og hvad hedder dit barn?');
            }
        }

        if (isset($session['name'])) {
            /** @var Subscriber $subscriber */
            $subscriber = Subscriber::create([
                'name' => $session['name'],
                'child_name' => $message,
                'phone' => $phone,
            ]);

            $lists = MessageList::all();
            foreach ($lists as $list) {
                $subscriber->messageLists()->attach($list);
                $this->sendMessage($list->phone_owner, $subscriber->name . ' som er forældre til ' . $subscriber->child_name . ' er blevet tilmeldt til listen.');
            }

            cache()->forget($cacheKey);

            return $this->sendMessage($phone, 'Du er blevet tilmeldt og får nu beskeder når Tulle skriver ud.');
        }

        return $this->sendMessage($phone, 'Prøv lige igen. Tilmeld ved at svare "tilmeld".');
    }

    private function sendMessage(string $phone, string $message) {
        SendMessageJob::dispatch($phone, $message);

        return 'OK';
    }
}
