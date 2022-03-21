<?php

namespace Repositories;

use PDO;
use Repositories\BaseRepository as BaseRepository;

class BlogRepository extends BaseRepository {

	/**
	 * getAllPosts
	 *
	 * @return array $data
	 */
	public function getAllPosts($offset, $limit)
	{
        $sql = "SELECT `id`, `title`, `description` from `posts` LIMIT :limit OFFSET :offset";

        $statement = $this->client->prepare($sql);
        $statement->bindValue(':limit', $limit);
        $statement->bindValue(':offset', $offset);

        $result = $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $data;

	}

    /**
	 * createPost
	 *
	 * @return boolean
	 */
	public function createPost($data)
	{
        $sql = 'INSERT INTO posts (title, description) VALUES (?, ?)';
        $statement = $this->client->prepare($sql);
        $true = $statement->execute([$data['title'], $data['description']]);

        return $true;

	}

    /**
	 * createPost
	 *
	 * @return array $data
	 */
	public function getPostById($id)
	{
        $sql = 'SELECT id, title, description from posts where id = :id';
        $statement = $this->client->prepare($sql);
        $statement->execute(['id' => $id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
	}
}