<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818064103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Добавляет в таблицу `cameras` колонку "Идентификатор камеры у владельца"';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cameras ADD key INT NOT NULL');
        $this->addSql('COMMENT ON COLUMN cameras.key IS \'Идентификатор камеры у владельца\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cameras DROP key');
    }
}
