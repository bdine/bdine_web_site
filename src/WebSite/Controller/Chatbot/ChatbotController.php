<?php

namespace WebSite\Controller\Chatbot;

use BotMan\BotMan\BotMan;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Yaml\Parser;

class ChatbotController
{
    private $botman;
    private $translator;
    private $parser;

    /**
     * MainController constructor.
     */
    public function __construct(BotMan $botman, Translator $translator, Parser $parser)
    {
        $this->botman=$botman;
        $this->translator=$translator;
        $this->parser=$parser;
        $this->initBotMan();
    }

    public function askQuestion(Request $request)
    {
        $this->botman->listen();
        return "";
    }

    protected function initBotMan()
    {
        $ressources = $this->translator->getCatalogue($this->translator->getLocale())->getResources();

        foreach($ressources as $resource){
            $allMessages = $this->parser->parse(file_get_contents($resource->getResource()));
            $chatBotMessages = $allMessages['chatbot']['messages'];

            foreach($chatBotMessages as $key => $message) {
                foreach($message['inputs'] as $input){
                    $this->botman->hears($input, function ($bot) use($message) {
                        $bot->reply($message['output']);
                    });
                }
            }
        }

        $this->botman->hears($this->translator->trans('chatbot.name_message.input'), function ($bot, $name) {
            $bot->reply($this->translator->trans('chatbot.name_message.output', array('%name%'=> $name)));
        });

        $this->botman->fallback(function($bot) {
            $bot->reply($this->translator->trans('chatbot.fallback_message'));
        });
    }
}