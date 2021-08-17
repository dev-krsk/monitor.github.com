<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817112031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Создает таблицы камер видеонаблюдения и их владельцев';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE public.cameras_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.owners_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.cameras (id INT NOT NULL, owner_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, title VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, angle DOUBLE PRECISION DEFAULT \'0\' NOT NULL, source VARCHAR(255) NOT NULL, preview VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_507BE9D67E3C61F9 ON public.cameras (owner_id)');
        $this->addSql('COMMENT ON TABLE public.cameras IS \'Таблица камер видеонаблюдения\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.id IS \'Ключевое поле\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.owner_id IS \'Ключевое поле\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.created_at IS \'Дата создания(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.updated_at IS \'Дата изменения(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.deleted_at IS \'Дата удаления(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.title IS \'Наименование камеры\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.latitude IS \'Широта\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.longitude IS \'Долгота\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.angle IS \'Угол\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.source IS \'Ссылка на транслюцию\'');
        $this->addSql('COMMENT ON COLUMN public.cameras.preview IS \'Ссылка на превью\'');
        $this->addSql('CREATE TABLE public.owners (id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE public.owners IS \'Таблица владельцев\'');
        $this->addSql('COMMENT ON COLUMN public.owners.id IS \'Ключевое поле\'');
        $this->addSql('COMMENT ON COLUMN public.owners.created_at IS \'Дата создания(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN public.owners.updated_at IS \'Дата изменения(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN public.owners.deleted_at IS \'Дата удаления(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN public.owners.title IS \'Наименование\'');
        $this->addSql('ALTER TABLE public.cameras ADD CONSTRAINT FK_507BE9D67E3C61F9 FOREIGN KEY (owner_id) REFERENCES public.owners (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE public.cameras DROP CONSTRAINT FK_507BE9D67E3C61F9');
        $this->addSql('DROP SEQUENCE public.cameras_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.owners_id_seq CASCADE');
        $this->addSql('DROP TABLE public.cameras');
        $this->addSql('DROP TABLE public.owners');
    }
}
