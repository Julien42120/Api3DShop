<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108083804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_print DROP FOREIGN KEY FK_4A3C116E7C9783D2');
        $this->addSql('ALTER TABLE cart_print DROP FOREIGN KEY FK_4A3C116EE308AC6F');
        $this->addSql('DROP TABLE cart_print');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_print (id INT AUTO_INCREMENT NOT NULL, printing_id INT NOT NULL, material_id INT NOT NULL, UNIQUE INDEX UNIQ_4A3C116EE308AC6F (material_id), UNIQUE INDEX UNIQ_4A3C116E7C9783D2 (printing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cart_print ADD CONSTRAINT FK_4A3C116E7C9783D2 FOREIGN KEY (printing_id) REFERENCES printing (id)');
        $this->addSql('ALTER TABLE cart_print ADD CONSTRAINT FK_4A3C116EE308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
    }
}
