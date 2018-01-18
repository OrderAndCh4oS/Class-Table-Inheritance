<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180117220239 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql(
            'CREATE TABLE section_abstract (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, `order` INT NOT NULL, discr VARCHAR(255) NOT NULL, INDEX IDX_E55805FD7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE section_abstract ADD CONSTRAINT FK_E55805FD7294869C FOREIGN KEY (article_id) REFERENCES article (id)'
        );
        $this->addSql('ALTER TABLE text_block DROP FOREIGN KEY FK_D5AF2D7F7294869C');
        $this->addSql('DROP INDEX IDX_D5AF2D7F7294869C ON text_block');
        $this->addSql('ALTER TABLE text_block DROP article_id, DROP title, DROP `order`, CHANGE id id INT NOT NULL');
        $this->addSql(
            'ALTER TABLE text_block ADD CONSTRAINT FK_D5AF2D7FBF396750 FOREIGN KEY (id) REFERENCES section_abstract (id) ON DELETE CASCADE'
        );
        $this->addSql('ALTER TABLE quote_block DROP FOREIGN KEY FK_8EE41A437294869C');
        $this->addSql('DROP INDEX IDX_8EE41A437294869C ON quote_block');
        $this->addSql('ALTER TABLE quote_block DROP article_id, DROP title, DROP `order`, CHANGE id id INT NOT NULL');
        $this->addSql(
            'ALTER TABLE quote_block ADD CONSTRAINT FK_8EE41A43BF396750 FOREIGN KEY (id) REFERENCES section_abstract (id) ON DELETE CASCADE'
        );
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql('ALTER TABLE text_block DROP FOREIGN KEY FK_D5AF2D7FBF396750');
        $this->addSql('ALTER TABLE quote_block DROP FOREIGN KEY FK_8EE41A43BF396750');
        $this->addSql('DROP TABLE section_abstract');
        $this->addSql(
            'ALTER TABLE quote_block ADD article_id INT DEFAULT NULL, ADD title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD `order` INT NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL'
        );
        $this->addSql(
            'ALTER TABLE quote_block ADD CONSTRAINT FK_8EE41A437294869C FOREIGN KEY (article_id) REFERENCES article (id)'
        );
        $this->addSql('CREATE INDEX IDX_8EE41A437294869C ON quote_block (article_id)');
        $this->addSql(
            'ALTER TABLE text_block ADD article_id INT DEFAULT NULL, ADD title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD `order` INT NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL'
        );
        $this->addSql(
            'ALTER TABLE text_block ADD CONSTRAINT FK_D5AF2D7F7294869C FOREIGN KEY (article_id) REFERENCES article (id)'
        );
        $this->addSql('CREATE INDEX IDX_D5AF2D7F7294869C ON text_block (article_id)');
    }
}
