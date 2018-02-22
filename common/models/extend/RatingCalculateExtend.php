<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 13.04.2017
 * Time: 20:26
 */

namespace common\models\extend;

use Yii;
use common\models\RatingCalculate;

/**
 * @property integer $calulateRaiting
*/

class RatingCalculateExtend extends RatingCalculate
{
    public $item1;
    public $item2;
    public $item3;
    public $item4;
    public $item5;
    public $item6;
    public $item7;
    public $item8;
    public $item9;
    public $item10;
    public $item11;
    public $item12;
    public $item13;
    public $item14;
    public $item15;
    public $item16;
    public $item17;
    public $item18;
    public $item19;
    public $item20;
    public $item21;
    public $item22;
    public $item23;
    public $item24;

    public function rules()
    {
        $items = RatingCalculate::rules();
        $items[] = [['item1', 'item2', 'item3', 'item4', 'item5', 'item6', 'item7', 'item8', 'item9', 'item10', 'item11', 'item12',
            'item13', 'item14', 'item15', 'item16', 'item17', 'item18', 'item19', 'item20', 'item21', 'item22', 'item23', 'item24'], 'string', 'max' => 11];
        /*$items[] = [['item1', 'item2', 'item3', 'item4', 'item5', 'item6', 'item7', 'item8', 'item9', 'item10', 'item11',
            'item12'], 'vaildateItem'];*/
        return $items;
    }

    public function attributeLabels()
    {
        $items = RatingCalculate::attributeLabels();
        $items['item1'] = Yii::t('app', '1');
        $items['item2'] = Yii::t('app', '2');
        $items['item3'] = Yii::t('app', '3');
        $items['item4'] = Yii::t('app', '4');
        $items['item5'] = Yii::t('app', '5');
        $items['item6'] = Yii::t('app', '6');
        $items['item7'] = Yii::t('app', '7');
        $items['item8'] = Yii::t('app', '8');
        $items['item9'] = Yii::t('app', '9');
        $items['item10'] = Yii::t('app', '10');
        $items['item11'] = Yii::t('app', '11');
        $items['item12'] = Yii::t('app', '12');
        $items['item13'] = Yii::t('app', '13');
        $items['item14'] = Yii::t('app', '14');
        $items['item15'] = Yii::t('app', '15');
        $items['item16'] = Yii::t('app', '16');
        $items['item17'] = Yii::t('app', '17');
        $items['item18'] = Yii::t('app', '18');
        $items['item19'] = Yii::t('app', '19');
        $items['item20'] = Yii::t('app', '20');
        $items['item21'] = Yii::t('app', '21');
        $items['item22'] = Yii::t('app', '22');
        $items['item23'] = Yii::t('app', '23');
        $items['item24'] = Yii::t('app', '24');
        return $items;
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $this->formula = $this->item1.','.$this->item2.','.$this->item3.','.$this->item4.','.$this->item5.','.$this->item6
            .','.$this->item7.','.$this->item8.','.$this->item9.','.$this->item10.','.$this->item11.','.$this->item12.','.$this->item13.','.$this->item14.','.$this->item15
            .','.$this->item16.','.$this->item17.','.$this->item18.','.$this->item19.','.$this->item20.','.$this->item21.','.$this->item22.','.$this->item23.','.$this->item24;
        return true;
    }

    public function getFormula() {
        return $this->item1.$this->item2.$this->item3.$this->item4.$this->item5.$this->item6.$this->item7.$this->item8.$this->item9.$this->item10
            .$this->item11.$this->item12.$this->item13.$this->item14.$this->item15.$this->item16.$this->item17.$this->item18.$this->item19.$this->item20
            .$this->item21.$this->item22.$this->item23.$this->item24;
    }

    public function getCalulateRaiting()
    {
        $formula = $this->getFormula();
        return $this->calculate($formula);
    }

    // Собственно сам вычислитель выражений
    private function calculate($statement) {
        if (!is_string($statement)) {
            dd('Wrong type');
        }
        $calcQueue = array();
        $operStack = array();
        $operPriority = array(
            '(' => 0,
            ')' => 0,
            '+' => 1,
            '-' => 1,
            '*' => 2,
            '/' => 2,
        );
        $token = '';
        foreach (str_split($statement) as $char) {
            // Если цифра, то собираем из цифр число
            if ($char >= '0' && $char <= '9') {
                $token .= $char;
            } else {
                // Если число накопилось, сохраняем в очереди вычисления
                if (strlen($token)) {
                    array_push($calcQueue, $token);
                    $token = '';
                }
                // Если найденный символ - операция (он есть в списке приоритетов)
                if (isset($operPriority[$char])) {
                    if (')' == $char) {
                        // Если символ - закрывающая скобка, переносим операции из стека в очередь вычисления пока не встретим открывающую скобку
                        while (!empty($operStack)) {
                            $oper = array_pop($operStack);
                            if ('(' == $oper) {
                                break;
                            }
                            array_push($calcQueue, $oper);
                        }
                        if ('(' != $oper) {
                            // Упс! А открывающей-то не было. Сильно ругаемся (18+)
                            dd('Unexpected ")"');
                        }
                    } else {
                        // Встретили операцию кроме скобки. Переносим операции с меньшим приоритетом в очередь вычисления
                        while (!empty($operStack) && '(' != $char) {
                            $oper = array_pop($operStack);
                            if ($operPriority[$char] > $operPriority[$oper]) {
                                array_push($operStack, $oper);
                                break;
                            }
                            if ('(' != $oper) {
                                array_push($calcQueue, $oper);
                            }
                        }
                        // Кладем операцию на стек операций
                        array_push($operStack, $char);
                    }
                } elseif (strpos(' ', $char) !== FALSE) {
                    // Игнорируем пробелы (можно добавить что еще игнорируем)
                } else {
                    // Встретили что-то непонятное (мы так не договаривались). Опять ругаемся
                    dd('Unexpected symbol "' . $char . '"');
                }
            }

        }
        // Вроде все разобрали, но если остались циферки добавляем их в очередь вычисления
        if (strlen($token)) {
            array_push($calcQueue, $token);
            $token = '';
        }
        // ... и оставшиеся в стеке операции
        if (!empty($operStack)) {
            while ($oper = array_pop($operStack)) {
                if ('(' == $oper) {
                    // ... кроме открывающих скобок. Это верный признак отсутствующей закрывающей
                    throw new AriphmeticException('Unexpected "("', 4);
                }
                array_push($calcQueue, $oper);
            }
        }
        $calcStack = array();
        // Теперь вычисляем все то, что напарсили
        // Тут ошибки не ловил, но они могут быть (это домашнее задание)
        foreach ($calcQueue as $token) {
            switch ($token) {
                case '+':
                    $arg2 = array_pop($calcStack);
                    $arg1 = array_pop($calcStack);
                    array_push($calcStack, $arg1 + $arg2);
                    break;
                case '-':
                    $arg2 = array_pop($calcStack);
                    $arg1 = array_pop($calcStack);
                    array_push($calcStack, $arg1 - $arg2);
                    break;
                case '*':
                    $arg2 = array_pop($calcStack);
                    $arg1 = array_pop($calcStack);
                    array_push($calcStack, $arg1 * $arg2);
                    break;
                case '/':
                    $arg2 = array_pop($calcStack);
                    $arg1 = array_pop($calcStack);
                    array_push($calcStack, $arg1 / $arg2);
                    break;
                default:
                    array_push($calcStack, $token);
            }
        }
        return array_pop($calcStack);
    }

    private function clearString($string)
    {
        return str_replace([' '], '', $string);
    }

    public function validateItem($index, $item)
    {
        if (ctype_digit($item)) {
            $this['item'.$index] = intval($item);
        } else {
            switch (true) {
                case ($item == '+' || $item == '-' || $item == '*' || $item == '/'
                    || $item == '(' || $item == ')' || $item == 'П' || $item == 'Г'
                    || $item == 'С' || $item == 'Р' || $item == 'Ц'
                ):
                    $this['item'.$index] = $item;
                    break;
                default:
                    $this['item'.$index] = $item;
                    $this->addError('item'.$index, '');
            }
        }
    }

    public function setParams()
    {
        if (Yii::$app->controller->action->id != 'update') {
            $formula = $this->clearString($this->formula);
            // количество элементов в строке
            $itemsArray = explode(',', $formula);
            // Пролистывае все элементы
            foreach ($itemsArray as $key => $value) {
                $this->validateItem($key + 1, $value);
            }
        }
    }
}