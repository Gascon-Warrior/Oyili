<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214154329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_job_worker (id INT AUTO_INCREMENT NOT NULL, video_id INT NOT NULL, job_id INT DEFAULT NULL, worker_id INT DEFAULT NULL, INDEX IDX_4F118A5529C1004E (video_id), INDEX IDX_4F118A55BE04EA9 (job_id), INDEX IDX_4F118A556B20BA36 (worker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_job_worker ADD CONSTRAINT FK_4F118A5529C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE video_job_worker ADD CONSTRAINT FK_4F118A55BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE video_job_worker ADD CONSTRAINT FK_4F118A556B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_job_worker DROP FOREIGN KEY FK_4F118A5529C1004E');
        $this->addSql('ALTER TABLE video_job_worker DROP FOREIGN KEY FK_4F118A55BE04EA9');
        $this->addSql('ALTER TABLE video_job_worker DROP FOREIGN KEY FK_4F118A556B20BA36');
        $this->addSql('DROP TABLE video_job_worker');
    }
}
