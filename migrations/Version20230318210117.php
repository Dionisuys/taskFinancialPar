<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230318210117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('manager');

        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $table->addColumn('username', Types::STRING, ['length' => 255]);
        $table->addColumn('password', Types::STRING, ['length' => 255]);
        $table->addColumn('login_date', Types::DATETIME_MUTABLE, ['notnull' => false]);

        $table->setPrimaryKey(['id']);
    }
}
