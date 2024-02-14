<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214122153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_worker (video_id INT NOT NULL, worker_id INT NOT NULL, INDEX IDX_A7E51FAF29C1004E (video_id), INDEX IDX_A7E51FAF6B20BA36 (worker_id), PRIMARY KEY(video_id, worker_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_worker ADD CONSTRAINT FK_A7E51FAF29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_worker ADD CONSTRAINT FK_A7E51FAF6B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_worker DROP FOREIGN KEY FK_A7E51FAF29C1004E');
        $this->addSql('ALTER TABLE video_worker DROP FOREIGN KEY FK_A7E51FAF6B20BA36');
        $this->addSql('DROP TABLE video_worker');
    }
}
