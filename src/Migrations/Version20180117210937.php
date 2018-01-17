<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180117210937 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_block (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, `order` INT NOT NULL, text VARCHAR(255) NOT NULL, article_id INT DEFAULT NULL, section VARCHAR(255) NOT NULL, INDEX IDX_D5AF2D7F7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote_block (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, `order` INT NOT NULL, text VARCHAR(255) NOT NULL, citation VARCHAR(255) NOT NULL, article_id INT DEFAULT NULL, section VARCHAR(255) NOT NULL, INDEX IDX_8EE41A437294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE text_block');
        $this->addSql('DROP TABLE quote_block');
    }
}
