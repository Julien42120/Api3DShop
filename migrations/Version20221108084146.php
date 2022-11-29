<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108084146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE config (id INT AUTO_INCREMENT NOT NULL, printing_id INT NOT NULL, material_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_D48A2F7C7C9783D2 (printing_id), UNIQUE INDEX UNIQ_D48A2F7CE308AC6F (material_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE config ADD CONSTRAINT FK_D48A2F7C7C9783D2 FOREIGN KEY (printing_id) REFERENCES printing (id)');
        $this->addSql('ALTER TABLE config ADD CONSTRAINT FK_D48A2F7CE308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE config DROP FOREIGN KEY FK_D48A2F7C7C9783D2');
        $this->addSql('ALTER TABLE config DROP FOREIGN KEY FK_D48A2F7CE308AC6F');
        $this->addSql('DROP TABLE config');
    }
}
