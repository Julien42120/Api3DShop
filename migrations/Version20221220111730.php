<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220111730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, billing_address VARCHAR(255) NOT NULL, delivery_address VARCHAR(255) NOT NULL, final_price INT NOT NULL, INDEX IDX_E52FFDEEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_printing (orders_id INT NOT NULL, printing_id INT NOT NULL, INDEX IDX_F7A9B035CFFE9AD6 (orders_id), INDEX IDX_F7A9B0357C9783D2 (printing_id), PRIMARY KEY(orders_id, printing_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE orders_printing ADD CONSTRAINT FK_F7A9B035CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_printing ADD CONSTRAINT FK_F7A9B0357C9783D2 FOREIGN KEY (printing_id) REFERENCES printing (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE orders_printing DROP FOREIGN KEY FK_F7A9B035CFFE9AD6');
        $this->addSql('ALTER TABLE orders_printing DROP FOREIGN KEY FK_F7A9B0357C9783D2');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_printing');
    }
}
