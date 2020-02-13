<?php declare(strict_types=1);

namespace PerfectApp\Html;

use Exception;
use InvalidArgumentException;

/**
 * Class HtmlTable
 */
class HtmlTable
{
    /**
     * @var bool
     */
    public $xhtml = true; // for col tags
    /**
     * @var string
     */
    public $tableStr;
    /**
     * @var array
     */
    private $thead = array();
    /**
     * @var array
     */
    private $tfoot = array();
    /**
     * @var array
     */
    private $tbody_ar = array();
    /**
     * @var mixed
     */
    private $cur_section;
    /**
     * @var array
     */
    private $colgroups_ar = array(); // if cols not in colgroup
    /**
     * @var array
     */
    private $cols_ar = array();

    /**
     * HtmlTable constructor.
     * @param string $id
     * @param string $klass
     * @param array $attr_ar
     */
    public function __construct(string $id = '', string $klass = '', array $attr_ar = [])
    {
        // add rows to tbody unless addTSection called
        $this->cur_section = &$this->tbody_ar[0];
        $this->tableStr = "\n<table" . (!empty($id) ? " id=\"$id\"" : '') . (!empty($klass) ? " class=\"$klass\"" : '') . $this->addAttribs($attr_ar) . ">\n";
    }

    /**
     * @param array $attr_ar
     * @return string
     */
    private function addAttribs(array $attr_ar): string
    {
        $str = '';
        foreach ($attr_ar as $key => $val)
        {
            $str .= " $key=\"$val\"";
        }
        return $str;
    }

    /**
     * @param string $sec
     * @param string $klass
     * @param array $attr_ar
     */
    final public function addTSection(string $sec, string $klass = '', array $attr_ar = []): void
    {
        switch ($sec)
        {
            case 'thead':
                $ref = &$this->thead;
                break;
            case 'tfoot':
                $ref = &$this->tfoot;
                break;
            case 'tbody':
                $ref = &$this->tbody_ar[count($this->tbody_ar)];
                break;

            default: // tbody
                $ref = &$this->tbody_ar[count($this->tbody_ar)];
        }

        $ref['klass'] = $klass;
        $ref['atts'] = $attr_ar;
        $ref['rows'] = [];

        $this->cur_section = &$ref;
    }

    /**
     * @param string $span
     * @param string $klass
     * @param array $attr_ar
     */
    final public function addColgroup(string $span = '', string $klass = '', array $attr_ar = []): void
    {
        $group = array('span' => $span, 'klass' => $klass, 'atts' => $attr_ar, 'cols' => []);
        $this->colgroups_ar[] = &$group;
    }

    /**
     * @param string $span
     * @param string $klass
     * @param array $attr_ar
     */
    final public function addCol(string $span = '', string $klass = '', array $attr_ar = []): void
    {
        $col = array('span' => $span, 'klass' => $klass, 'atts' => $attr_ar);

        // in colgroup?
        if (!empty($this->colgroups_ar))
        {
            $group = &$this->colgroups_ar[count($this->colgroups_ar) - 1];
            $group['cols'][] = &$col;
        }
        else
        {
            $this->cols_ar[] = &$col;
        }
    }

    /**
     * @param string $cap
     * @param string $klass
     * @param array $attr_ar
     */
    final public function addCaption(string $cap, string $klass = '', array $attr_ar = []): void
    {
        $this->tableStr .= '<caption' . (!empty($klass) ? ' class="$klass"' : '') . $this->addAttribs($attr_ar) . '>' . $cap . "</caption>\n";
    }

    /**
     * @param string $klass
     * @param array $attr_ar
     */
    final public function addRow(string $klass = '', array $attr_ar = []): void
    {
        // add row to current section
        $this->cur_section['rows'][] = array('klass' => $klass, 'atts' => $attr_ar, 'cells' => array());
    }

    /**
     * @param string $data
     * @param string $klass
     * @param string $type
     * @param array $attr_ar
     */
    final public function addCell(string $data = '', string $klass = '', string $type = 'data', array $attr_ar = []): void
    {
        $cell = array('data' => $data, 'klass' => $klass, 'type' => $type, 'atts' => $attr_ar);

        if (empty($this->cur_section['rows']))
        {
            try
            {
                throw new InvalidArgumentException('You need to addRow before you can addCell');
            }
            catch (Exception $ex)
            {
                $msg = $ex->getMessage();
                echo "<p>Error: $msg</p>";
            }
        }

        // add to current section's current row's list of cells
        $count = count($this->cur_section['rows']);
        $curRow = &$this->cur_section['rows'][$count - 1];
        $curRow['cells'][] = &$cell;
    }

    /**
     * @return string
     */
    final public function display(): string
    {
        // get colgroups/cols
        $this->tableStr .= $this->getColgroups();

        // get sections and their rows/cells
        $this->tableStr .= !empty($this->thead) ? $this->getSection($this->thead, 'thead') : '';
        $this->tableStr .= !empty($this->tfoot) ? $this->getSection($this->tfoot, 'tfoot') : '';

        foreach ($this->tbody_ar as $sec)
        {
            $this->tableStr .= !empty($sec) ? $this->getSection($sec, 'tbody') : '';
        }

        $this->tableStr .= "</table>\n";
        return $this->tableStr;
    }

    /**
     * @return string
     */
    private function getColgroups(): string
    {
        $str = '';

        if (!empty($this->colgroups_ar))
        {
            foreach ($this->colgroups_ar as $group)
            {
                $str .= '<colgroup' . (!empty($group['span']) ? ' span="{$group["span"]}"' : '') . (!empty($group['klass']) ? ' class="{$group["klass"]}"' : '') . $this->addAttribs($group['atts']) . '>' . $this->getCols($group['cols']) . "</colgroup>\n";
            }
        }
        else
        {
            $str .= $this->getCols($this->cols_ar);
        }
        return $str;
    }

    /**
     * @param array $ar
     * @return string
     */
    private function getCols(array $ar): string
    {
        $str = '';
        foreach ($ar as $col)
        {
            $str .= '<col' . (!empty($col['span']) ? ' span="{$col["span"]}"' : '') . (!empty($col['klass']) ? ' class="{$col["klass"]}"' : '') . $this->addAttribs($col['atts']) . ($this->xhtml ? ' />' : '>');
        }
        return $str;
    }

    /**
     * @param array $sec
     * @param string $tag
     * @return string
     */
    private function getSection(array $sec, string $tag): string
    {
        $klass = !empty($sec['klass']) ? " class=\"{$sec['klass']}\"" : '';
        $atts = !empty($sec['atts']) ? $this->addAttribs($sec['atts']) : '';
        $str = "<$tag" . $klass . $atts . ">\n";

        foreach ($sec['rows'] as $row)
        {
            $str .= (!empty($row['klass']) ? '  <tr class="{$row["klass"]}"' : '  <tr') . $this->addAttribs($row['atts']) . ">\n" . $this->getRowCells($row['cells']) . "  </tr>\n";
        }

        $str .= "</$tag>\n";
        return $str;
    }

    /**
     * @param array $cells
     * @return string
     */
    private function getRowCells(array $cells): string
    {
        $str = '';
        foreach ($cells as $cell)
        {
            $tag = ($cell['type'] === 'data') ? 'td' : 'th';
            $str .= (!empty($cell['klass']) ? '    <$tag class="{$cell["klass"]}"' : "    <$tag") . $this->addAttribs($cell['atts']) . '>' . $cell['data'] . "</$tag>\n";
        }
        return $str;
    }
}
