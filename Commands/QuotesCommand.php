<?php

/**
 * This file is part of the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * User "/markdown" command
 *
 * Print some text formatted with markdown.
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ReplyKeyboardMarkup;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class QuotesCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'quote';

    /**
     * @var string
     */
    protected $description = 'Random quotes';

    /**
     * @var string
     */
    protected $usage = '/quotes';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        $t = "";

		$json = file_get_contents('https://zenquotes.io/api/random');
		$data = json_decode($json,true);
		
		if($data = $data[0]){
		    $t = $data['q']."\n\n👤 ".$data['a'];
		}else{
			$t = "Failed.";
		}
		
        return $this->replyToChat($t);
    }
}