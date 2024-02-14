<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214105641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, worker_id INT DEFAULT NULL, picture_file_name VARCHAR(255) NOT NULL, is_promoted TINYINT(1) NOT NULL, INDEX IDX_16DB4F8919EB6921 (client_id), INDEX IDX_16DB4F896B20BA36 (worker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F896B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8919EB6921');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F896B20BA36');
        $this->addSql('DROP TABLE picture');
    }
}
