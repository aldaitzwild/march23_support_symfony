<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230627144400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638979B1AD6 ON contact (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638979B1AD6');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP INDEX IDX_4C62E638979B1AD6 ON contact');
        $this->addSql('ALTER TABLE contact DROP company_id');
    }
}
