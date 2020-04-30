<?php

namespace App\Console\Commands;

use App\User;
use App\Item;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FetchItems extends Command
{
    const ENDPOINT_DRUPAL_NODES = 'https://www.drupal.org/api-d7/node.json?sort=nid&direction=DESC';
    const ENDPOINT_DRUPAL_COMMENTS = 'https://www.drupal.org/api-d7/comment.json?sort=cid&direction=DESC';
    const ENDPOINT_GITHUB_ACTIVITY = 'https://github.com/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch items';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            // Drupal.
            if ($user->drupal_user_id) {
                // // Drupal nodes.
                $result = json_decode(file_get_contents(self::ENDPOINT_DRUPAL_NODES . '&author=' . $user->drupal_user_id));
                $remoteItems = $result->list;
                foreach ($remoteItems as $remoteItem) {
                    if (!Item::where('url', '=', $remoteItem->url)->count()) {
                        $item = new Item;
                        $item->user_id = $user->id;
                        $item->title = $remoteItem->title;
                        $item->url = $remoteItem->url;
                        $item->save();
                    }
                }
                // Drupal comments.
                $result = json_decode(
                    file_get_contents(self::ENDPOINT_DRUPAL_COMMENTS . '&author=' . $user->drupal_user_id)
                );
                $remoteItems = $result->list;
                foreach ($remoteItems as $remoteItem) {
                    if (!Item::where('url', '=', $remoteItem->url)->count()) {
                        if ($remoteItem->subject !== '' || $remoteItem->comment_body && $remoteItem->comment_body->value !== '') {
                            $item = new Item;
                            $item->user_id = $user->id;
                            $item->title = $remoteItem->subject !== ''
                            ? $remoteItem->subject
                            : Str::limit(strip_tags($remoteItem->comment_body->value), 252);
                            $item->url = $remoteItem->url;
                            $item->save();
                        }
                    }
                }
                // GitHub activity.
                $result = simplexml_load_file(self::ENDPOINT_GITHUB_ACTIVITY . $user->github_user_name . '.atom');
                foreach ($result->entry as $remoteItem) {
                    if (!Item::where('url', '=', $remoteItem->link->attributes['href'])->count()) {
                        $item = new Item;
                        $item->user_id = $user->id;
                        $item->title = $remoteItem->title[0];
                        $item->url = $remoteItem->link->attributes['href'];
                        $item->save();
                    }
                }
            }
        }
    }
}