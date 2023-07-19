<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230719063838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE asked_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE asked (id INT NOT NULL, ask_applicant_id INT DEFAULT NULL, ask_subject VARCHAR(255) NOT NULL, ask_description TEXT NOT NULL, ask_created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ask_sended BOOLEAN DEFAULT NULL, ask_sended_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D2DB8F06D6AE778 ON asked (ask_applicant_id)');
        $this->addSql('ALTER TABLE asked ADD CONSTRAINT FK_D2DB8F06D6AE778 FOREIGN KEY (ask_applicant_id) REFERENCES applicant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE asked_id_seq CASCADE');
        $this->addSql('ALTER TABLE asked DROP CONSTRAINT FK_D2DB8F06D6AE778');
        $this->addSql('DROP TABLE asked');
    }
}
