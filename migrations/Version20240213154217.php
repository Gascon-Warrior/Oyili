<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213154217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, client_case_id INT DEFAULT NULL, company VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, tagline LONGTEXT NOT NULL, client_feedback LONGTEXT DEFAULT NULL, work_presentation LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, relation VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C74404559D2D9088 (client_case_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_case (id INT AUTO_INCREMENT NOT NULL, presentation LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559D2D9088 FOREIGN KEY (client_case_id) REFERENCES client_case (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404559D2D9088');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_case');
    }
}
