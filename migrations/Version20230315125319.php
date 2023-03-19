<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20230315125319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $tableClient = $schema->createTable('client');
        $tableClient->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $tableClient->addColumn('name', Types::STRING, ['length' => 255]);
        $tableClient->addColumn('last_name', Types::STRING, ['length' => 255]);
        $tableClient->addColumn('phone', Types::STRING, ['length' => 20]);
        $tableClient->addColumn('email', Types::STRING, ['length' => 255]);
        $tableClient->addColumn('comment', Types::TEXT, ['notnull' => false]);
        $tableClient->addColumn('manager_id', Types::INTEGER);
        $tableClient->setPrimaryKey(['id']);
        $tableClient->addForeignKeyConstraint('manager', ['manager_id'], ['id'], ['onDelete' => 'CASCADE']);
    }

    public function down(Schema $schema): void
    {
        $schema->getTable('client')->removeForeignKey('manager_id');
        $schema->dropTable('client');
    }
}