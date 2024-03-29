<title># Num</title>

<code-block lang="php">
<![CDATA[abstract class \FireHub\Core\Support\LowLevel\Num()]]>
</code-block>







<tip>
    <p>
        This is an <format style="bold">abstract</format> class that cannot be instantiated directly.
    </p>
</tip>





### ### Number low-level proxy class

<p><format style="italic">Class contains methods that are used on all number types.</format></p>

<deflist>
    <def title="Class basic info:">
        <list><li>This class was created by Danijel Galić &lt;danijel.galic@outlook.com&gt;</li><li>Copyright: 2024 FireHub Web Application Framework</li><li>License: &lt;https://opensource.org/licenses/OSL-3.0&gt; OSL Open Source License version 3</li><li>Version: GIT: $Id$ Blob checksum.</li></list>
    </def>
</deflist>

<deflist><def title="Fully Qualified Class Name:">
        \FireHub\Core\Support\LowLevel\Num
    </def><def title="Source code:">
        <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L40">
            View source code
        </a>
    </def>
    <def title="Blame:">
        <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php">
            View blame
        </a>
    </def>
    <def title="History:">
        <a href="https://github.com/The-FireHub-Project/Core/commits/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php">
            View history
        </a>
    </def></deflist>
### Changelog
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>


### Methods
| Type | Name | Title |
|:-----|:-----|:------|
|public static |<a href="#absolute()">absolute</a>|### Absolute value|
|public static |<a href="#ceil()">ceil</a>|### Round fractions up|
|public static |<a href="#floor()">floor</a>|### Round fractions down|
|public static |<a href="#round()">round</a>|### Rounds a float|
|public static |<a href="#log()">log</a>|### Natural logarithm|
|public static |<a href="#log1p()">log1p</a>|### Returns log(1 + number), computed in a way that is accurate even when the value of number is close to zero|
|public static |<a href="#log10()">log10</a>|### Base-10 logarithm|
|public static |<a href="#max()">max</a>|### Find highest value|
|public static |<a href="#min()">min</a>|### Find lowest value|
|public static |<a href="#power()">power</a>|### Exponential expression|
|public static |<a href="#format()">format</a>|### Format a number with grouped thousands|

## method: absolute {id="absolute()"}

<code-block lang="php">
    <![CDATA[final public static Num::absolute(float|int $number):int|float]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Absolute value

<p><format style="italic">Returns the absolute value of $number.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L55">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L55">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>float or int <format style="bold">$number</format> - <format style="italic">
The numeric value to process.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int or float - <format style="italic"><code>($number is int ? int : float)</code> The absolute value of number.</format></li></list>
    </def>
</deflist>
## method: ceil {id="ceil()"}

<code-block lang="php">
    <![CDATA[final public static Num::ceil(float|int $number):int]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Round fractions up

<p><format style="italic">Returns the next highest integer value by rounding up $number if necessary.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L75">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L75">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method uses:">
        <list><li><a href="NumFloat.md#round()">\FireHub\Core\Support\LowLevel\NumFloat::round()</a>  - <format style="italic">To round $number parameter.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>float or int <format style="bold">$number</format> - <format style="italic">
The value to round up.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int - <format style="italic">Rounded number up to the next highest integer.</format></li></list>
    </def>
</deflist>
## method: floor {id="floor()"}

<code-block lang="php">
    <![CDATA[final public static Num::floor(float|int $number):int]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Round fractions down

<p><format style="italic">Returns the next lowest integer value (as float) by rounding down $number if necessary.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L95">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L95">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method uses:">
        <list><li><a href="NumFloat.md#round()">\FireHub\Core\Support\LowLevel\NumFloat::round()</a>  - <format style="italic">To round $number parameter.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>float or int <format style="bold">$number</format> - <format style="italic">
The value to round down.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int - <format style="italic">Rounded number up to the next lowest integer.</format></li></list>
    </def>
</deflist>
## method: round {id="round()"}

<code-block lang="php">
    <![CDATA[final public static Num::round(float|int $number, int $precision, \FireHub\Core\Support\Enums\Number\Round $round = Round::HALF_UP):float|int]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Rounds a float

<p><format style="italic">Returns the rounded value of $number to specified $precision (number of digits after the decimal point).
$precision can also be negative or zero (default).</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L129">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L129">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method uses:">
        <list><li><a href="Round.md#half_up">\FireHub\Core\Support\Enums\Number\Round::HALF_UP</a>  - <format style="italic">Round number enum.</format></li><li><a href="Round.md#half_down">\FireHub\Core\Support\Enums\Number\Round::HALF_DOWN</a>  - <format style="italic">Round number enum.</format></li><li><a href="Round.md#half_even">\FireHub\Core\Support\Enums\Number\Round::HALF_EVEN</a>  - <format style="italic">Round number enum.</format></li><li><a href="Round.md#half_odd">\FireHub\Core\Support\Enums\Number\Round::HALF_ODD</a>  - <format style="italic">Round number enum.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>float or int <format style="bold">$number</format> - <format style="italic">
The value to round.
</format></li><li>int <format style="bold">$precision</format> - <format style="italic">[optional] 
Number of decimal digits to round to. If the precision is positive, num is rounded to precision significant
digits after the decimal point. If the precision is negative, num is rounded to precision significant digits
before the decimal point, i.e., to the nearest multiple of pow(10, -$precision), e.g. for a precision of -1
num is rounded to tens, for a precision of -2 to hundreds, etc.
</format></li><li><a href="Round.md">\FireHub\Core\Support\Enums\Number\Round</a> <format style="bold">$round</format> = Round::HALF_UP - <format style="italic">[optional] 
Specify the mode in which rounding occurs.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>float or int - <format style="italic"><code>($precision is positive-int ? float : int)</code> Rounded number float.</format></li></list>
    </def>
</deflist>
## method: log {id="log()"}

<code-block lang="php">
    <![CDATA[final public static Num::log(float|int $number, \FireHub\Core\Support\Enums\Number\LogBase|float $base = LogBase::E):float]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Natural logarithm



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L158">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L158">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method uses:">
        <list><li><a href="LogBase.md#e">\FireHub\Core\Support\Enums\Number\LogBase::E</a>  - <format style="italic">As default parameter.</format></li><li><a href="LogBase.md#value()">\FireHub\Core\Support\Enums\Number\LogBase::value()</a>  - <format style="italic">To get log value.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>float or int <format style="bold">$number</format> - <format style="italic">
The value to calculate the logarithm for.
</format></li><li><a href="LogBase.md">\FireHub\Core\Support\Enums\Number\LogBase</a> or float <format style="bold">$base</format> = LogBase::E - <format style="italic">[optional] 
The optional logarithmic base to use (defaults to 'e' and so to the natural logarithm).
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>float - <format style="italic">The logarithm of $number to $base, if given, or the natural logarithm.</format></li></list>
    </def>
</deflist>
## method: log1p {id="log1p()"}

<code-block lang="php">
    <![CDATA[final public static Num::log1p(float|int $number):float]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Returns log(1 + number), computed in a way that is accurate even when the value of number is close to zero



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L174">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L174">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>float or int <format style="bold">$number</format> - <format style="italic">
The argument to process.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>float - <format style="italic">log(1 + num).</format></li></list>
    </def>
</deflist>
## method: log10 {id="log10()"}

<code-block lang="php">
    <![CDATA[final public static Num::log10(float|int $number):float]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Base-10 logarithm



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L190">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L190">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>float or int <format style="bold">$number</format> - <format style="italic">
The argument to process.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>float - <format style="italic">The base-10 logarithm of num.</format></li></list>
    </def>
</deflist>
## method: max {id="max()"}

<code-block lang="php">
    <![CDATA[final public static Num::max(\FireHub\Core\Support\LowLevel\TInt $value, \FireHub\Core\Support\LowLevel\TInt ...$values):int|float]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Find highest value



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L214">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L214">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has templates:">
        <list><li>TInt of int|float</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li><a href="TInt.md">\FireHub\Core\Support\LowLevel\TInt</a> <format style="bold">$value</format> - <format style="italic">
<code>TInt</code>
Any comparable value.
</format></li><li>variadic <a href="TInt.md">\FireHub\Core\Support\LowLevel\TInt</a> <format style="bold">$values</format> - <format style="italic">
<code>TInt</code>
Any comparable values.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int or float - <format style="italic"><code>TInt</code> Value considered "highest" according to standard comparisons.</format></li></list>
    </def>
</deflist>
## method: min {id="min()"}

<code-block lang="php">
    <![CDATA[final public static Num::min(\FireHub\Core\Support\LowLevel\TInt $value, \FireHub\Core\Support\LowLevel\TInt ...$values):int|float]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Find lowest value



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L238">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L238">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has templates:">
        <list><li>TInt of int|float</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li><a href="TInt.md">\FireHub\Core\Support\LowLevel\TInt</a> <format style="bold">$value</format> - <format style="italic">
<code>TInt</code>
Any comparable value.
</format></li><li>variadic <a href="TInt.md">\FireHub\Core\Support\LowLevel\TInt</a> <format style="bold">$values</format> - <format style="italic">
<code>TInt</code>
Any comparable values.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int or float - <format style="italic"><code>TInt</code> Value considered "lowest" according to standard comparisons.</format></li></list>
    </def>
</deflist>
## method: power {id="power()"}

<code-block lang="php">
    <![CDATA[final public static Num::power(float|int $base, float|int $exponent):float|int]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Exponential expression



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L261">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L261">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>float or int <format style="bold">$base</format> - <format style="italic">
The base to use.
</format></li><li>float or int <format style="bold">$exponent</format> - <format style="italic">
The exponent.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>float or int - <format style="italic">Base raised to the power of exponent. If both arguments are non-negative integers and the
result can be represented as an integer, the result will be returned with an int type, otherwise it will be
returned as a float.</format></li></list>
    </def>
</deflist>
## method: format {id="format()"}

<code-block lang="php">
    <![CDATA[final public static Num::format(int|float $number, int $decimals, string $decimal_separator = &#039;.&#039;, string $thousands_separator = &#039;,&#039;):string]]>
</code-block>





<tip>
    <p>
        This method is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Format a number with grouped thousands

<p><format style="italic">Formats a number with grouped thousands and optionally decimal digits using the rounding half up rule.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L290">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Num.php#L290">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>int or float <format style="bold">$number</format> - <format style="italic">
The number being formatted.
</format></li><li>int <format style="bold">$decimals</format> - <format style="italic">
<code>non-negative-int</code>
Sets the number of decimal digits. If 0, the decimal_separator is omitted from the return value.
</format></li><li>string <format style="bold">$decimal_separator</format> = '.' - <format style="italic">
Sets the separator for the decimal point.
</format></li><li>string <format style="bold">$thousands_separator</format> = ',' - <format style="italic">
Sets the separator for thousands.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>string - <format style="italic">A formatted version of number.</format></li></list>
    </def>
</deflist>