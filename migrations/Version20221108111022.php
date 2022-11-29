<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108111022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE config DROP FOREIGN KEY FK_D48A2F7CE308AC6F');
        $this->addSql('DROP INDEX UNIQ_D48A2F7CE308AC6F ON config');
        $this->addSql('ALTER TABLE config DROP material_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE config ADD material_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE config ADD CONSTRAINT FK_D48A2F7CE308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D48A2F7CE308AC6F ON config (material_id)');
    }
}
