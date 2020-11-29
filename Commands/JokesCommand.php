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

class JokesCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'jokes';

    /**
     * @var string
     */
    protected $description = 'Random jokes';

    /**
     * @var string
     */
    protected $usage = '/jokes';

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

		$json = file_get_contents('https://sv443.net/jokeapi/v2/joke/Any?blacklistFlags=nsfw,religious,political,racist,sexist');
		$data = json_decode($json,true);
		
		if($data['error'] == false){
			
            switch ($data['type']) {
                case 'single':
                    $t = $data['joke'];
                    break;
                case 'twopart':
                    $t = $data['setup']."\n\n".$data['delivery'];
                    break;
                default:
                    $t = "Try again.";
                    break;
            }
			
			
		}else{
			$t = "Failed.";
		}
		
        return $this->replyToChat($t);
    }
}