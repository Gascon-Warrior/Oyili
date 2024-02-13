<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214093939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404559D2D9088');
        $this->addSql('DROP INDEX UNIQ_C74404559D2D9088 ON client');
        $this->addSql('ALTER TABLE client DROP client_case_id, DROP relation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD client_case_id INT DEFAULT NULL, ADD relation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559D2D9088 FOREIGN KEY (client_case_id) REFERENCES client_case (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404559D2D9088 ON client (client_case_id)');
    }
}
