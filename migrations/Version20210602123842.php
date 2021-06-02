<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602123842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consumable (id INT AUTO_INCREMENT NOT NULL, machine_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, family VARCHAR(64) DEFAULT NULL, reference VARCHAR(32) NOT NULL, quantity INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4475F095F6B75B26 (machine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE envelope (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, reference VARCHAR(32) NOT NULL, quantity INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE machine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paper (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, reference VARCHAR(5) NOT NULL, quantity INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_4E1A60165E237E06 (name), UNIQUE INDEX UNIQ_4E1A6016AEA34913 (reference), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supply (id INT AUTO_INCREMENT NOT NULL, machine_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, reference VARCHAR(32) NOT NULL, quantity INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D219948CF6B75B26 (machine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consumable ADD CONSTRAINT FK_4475F095F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('ALTER TABLE supply ADD CONSTRAINT FK_D219948CF6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consumable DROP FOREIGN KEY FK_4475F095F6B75B26');
        $this->addSql('ALTER TABLE supply DROP FOREIGN KEY FK_D219948CF6B75B26');
        $this->addSql('DROP TABLE consumable');
        $this->addSql('DROP TABLE envelope');
        $this->addSql('DROP TABLE machine');
        $this->addSql('DROP TABLE paper');
        $this->addSql('DROP TABLE supply');
        $this->addSql('DROP TABLE user');
    }
}
