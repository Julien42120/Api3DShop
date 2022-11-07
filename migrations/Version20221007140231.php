<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007140231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_printing DROP FOREIGN KEY FK_AE1022987C9783D2');
        $this->addSql('ALTER TABLE cart_printing DROP FOREIGN KEY FK_AE102298E308AC6F');
        $this->addSql('DROP TABLE cart_printing');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_printing (id INT AUTO_INCREMENT NOT NULL, printing_id INT DEFAULT NULL, material_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_AE102298E308AC6F (material_id), UNIQUE INDEX UNIQ_AE1022987C9783D2 (printing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cart_printing ADD CONSTRAINT FK_AE1022987C9783D2 FOREIGN KEY (printing_id) REFERENCES printing (id)');
        $this->addSql('ALTER TABLE cart_printing ADD CONSTRAINT FK_AE102298E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
    }
}
