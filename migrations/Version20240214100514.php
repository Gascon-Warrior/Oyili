<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214100514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE worker (id INT AUTO_INCREMENT NOT NULL, position VARCHAR(255) NOT NULL, presentation LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE worker_job (worker_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_5FDD3D486B20BA36 (worker_id), INDEX IDX_5FDD3D48BE04EA9 (job_id), PRIMARY KEY(worker_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE worker_job ADD CONSTRAINT FK_5FDD3D486B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE worker_job ADD CONSTRAINT FK_5FDD3D48BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE worker_job DROP FOREIGN KEY FK_5FDD3D486B20BA36');
        $this->addSql('ALTER TABLE worker_job DROP FOREIGN KEY FK_5FDD3D48BE04EA9');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE worker');
        $this->addSql('DROP TABLE worker_job');
    }
}
