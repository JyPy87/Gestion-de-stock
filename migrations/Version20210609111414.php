<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210609111414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consumable CHANGE reference reference VARCHAR(5) NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4475F0955E237E06 ON consumable (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4475F095AEA34913 ON consumable (reference)');
        $this->addSql('ALTER TABLE envelope CHANGE reference reference VARCHAR(5) NOT NULL, CHANGE quantity quantity INT NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8A9578685E237E06 ON envelope (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8A957868AEA34913 ON envelope (reference)');
        $this->addSql('ALTER TABLE supply CHANGE reference reference VARCHAR(5) NOT NULL, CHANGE quantity quantity INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D219948C5E237E06 ON supply (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D219948CAEA34913 ON supply (reference)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_4475F0955E237E06 ON consumable');
        $this->addSql('DROP INDEX UNIQ_4475F095AEA34913 ON consumable');
        $this->addSql('ALTER TABLE consumable CHANGE reference reference VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8A9578685E237E06 ON envelope');
        $this->addSql('DROP INDEX UNIQ_8A957868AEA34913 ON envelope');
        $this->addSql('ALTER TABLE envelope CHANGE reference reference VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE quantity quantity INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('DROP INDEX UNIQ_D219948C5E237E06 ON supply');
        $this->addSql('DROP INDEX UNIQ_D219948CAEA34913 ON supply');
        $this->addSql('ALTER TABLE supply CHANGE reference reference VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE quantity quantity INT DEFAULT NULL');
    }
}
