<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518192733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE machine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consumable ADD machine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consumable ADD CONSTRAINT FK_4475F095F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('CREATE INDEX IDX_4475F095F6B75B26 ON consumable (machine_id)');
        $this->addSql('ALTER TABLE supply ADD machine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE supply ADD CONSTRAINT FK_D219948CF6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('CREATE INDEX IDX_D219948CF6B75B26 ON supply (machine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consumable DROP FOREIGN KEY FK_4475F095F6B75B26');
        $this->addSql('ALTER TABLE supply DROP FOREIGN KEY FK_D219948CF6B75B26');
        $this->addSql('DROP TABLE machine');
        $this->addSql('DROP INDEX IDX_4475F095F6B75B26 ON consumable');
        $this->addSql('ALTER TABLE consumable DROP machine_id');
        $this->addSql('DROP INDEX IDX_D219948CF6B75B26 ON supply');
        $this->addSql('ALTER TABLE supply DROP machine_id');
    }
}
