<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007090320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_printing DROP FOREIGN KEY FK_AE1022981AD5CDBF');
        $this->addSql('DROP INDEX IDX_AE1022981AD5CDBF ON cart_printing');
        $this->addSql('ALTER TABLE cart_printing DROP cart_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_printing ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart_printing ADD CONSTRAINT FK_AE1022981AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_AE1022981AD5CDBF ON cart_printing (cart_id)');
    }
}
