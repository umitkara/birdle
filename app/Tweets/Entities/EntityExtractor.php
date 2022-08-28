<?php

namespace App\Tweets\Entities;

class EntityExtractor
{
    protected String $string;

    const HASHTAG_PATTERN = '/(?!\s)#([A-Za-z]\w*)\b/';
    const MENTION_PATTERN = '/(?=[^\w!])@(\w+)\b/';

    public function __construct(String $string)
    {
        $this->string = $string;
    }

    public function getHashtags(): array
    {
        return $this->buildEntityCollection(
            $this->match(self::HASHTAG_PATTERN),
            EntityType::HASHTAG
        );
    }

    public function getMentions(): array
    {
        return $this->buildEntityCollection(
            $this->match(self::MENTION_PATTERN),
            EntityType::MENTION
        );
    }

    public function getAllEntities(): array
    {
        return array_merge(
            $this->getHashtags(),
            $this->getMentions()
        );
    }

    protected function match(String $pattern)
    {
        preg_match_all($pattern, $this->string, $matches, PREG_OFFSET_CAPTURE);
        return $matches;
    }

    protected function buildEntityCollection(array $entities, String $type): array
    {
        return array_map(function ($entity, $index) use ($entities, $type) {
            return [
                'body' => $entity[0],
                'body_plain' => $entities[1][$index][0],
                'start' => $start = $entity[1],
                'end' => $start + strlen($entity[0]),
                'type' => $type,
            ];
        }, $entities[0], array_keys($entities[0]));
    }
}
