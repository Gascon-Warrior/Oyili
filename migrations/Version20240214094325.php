<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214094325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_case ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE client_case ADD CONSTRAINT FK_A9945A6619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A9945A6619EB6921 ON client_case (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_case DROP FOREIGN KEY FK_A9945A6619EB6921');
        $this->addSql('DROP INDEX UNIQ_A9945A6619EB6921 ON client_case');
        $this->addSql('ALTER TABLE client_case DROP client_id');
    }
}
