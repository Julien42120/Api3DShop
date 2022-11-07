<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007140626 extends AbstractMigration
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
        $this->addSql('DROP INDEX UNIQ_4A3C116EE308AC6F ON cart_print');
        $this->addSql('DROP INDEX UNIQ_4A3C116E7C9783D2 ON cart_print');
        $this->addSql('ALTER TABLE cart_print DROP printing_id, DROP material_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_print ADD printing_id INT NOT NULL, ADD material_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart_print ADD CONSTRAINT FK_4A3C116E7C9783D2 FOREIGN KEY (printing_id) REFERENCES printing (id)');
        $this->addSql('ALTER TABLE cart_print ADD CONSTRAINT FK_4A3C116EE308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4A3C116EE308AC6F ON cart_print (material_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4A3C116E7C9783D2 ON cart_print (printing_id)');
    }
}
