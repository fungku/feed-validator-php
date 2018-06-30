<?php

namespace Fungku\MarkupValidator;

use Fungku\MarkupValidator\Contracts\FeedValidatorInterface;

class W3CFeedValidator implements FeedValidatorInterface
{
    /**
     * Validate the atom or rss feed.
     *
     * @param string $feed The url of the feed to validate.
     * @return bool
     */
    public function validate($feed)
    {
        $validator = "http://validator.w3.org/feed/check.cgi?output=soap12&url={$feed}";
        $response = file_get_contents($validator);

        $xml = new \DOMDocument();
        $xml->loadXML($response);

        $validity = $xml->getElementsByTagName('validity');

        return $validity->length && $validity->item(0)->nodeValue == 'true';
    }
}
