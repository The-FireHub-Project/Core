<title># Arr</title>

<code-block lang="php">
<![CDATA[final class \FireHub\Core\Support\LowLevel\Arr()]]>
</code-block>





<tip>
    <p>
        This class is marked as <format style="bold">final</format>.
    </p>
</tip>







### ### Array low-level proxy class



<deflist>
    <def title="Class basic info:">
        <list><li>This class was created by Danijel Galić &lt;danijel.galic@outlook.com&gt;</li><li>Copyright: 2024 FireHub Web Application Framework</li><li>License: &lt;https://opensource.org/licenses/OSL-3.0&gt; OSL Open Source License version 3</li><li>Version: GIT: $Id$ Blob checksum.</li></list>
    </def>
</deflist>

<deflist><def title="Fully Qualified Class Name:">
        \FireHub\Core\Support\LowLevel\Arr
    </def><def title="Source code:">
        <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L104">
            View source code
        </a>
    </def>
    <def title="Blame:">
        <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php">
            View blame
        </a>
    </def>
    <def title="History:">
        <a href="https://github.com/The-FireHub-Project/Core/commits/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php">
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
|public static |<a href="#keyexist()">keyExist</a>|### Checks if the given key or index exists in the array|
|public static |<a href="#inarray()">inArray</a>|### Checks if a value exists in an array|
|public static |<a href="#islist()">isList</a>|### Checks whether a given array is a list|
|public static |<a href="#multisort()">multiSort</a>|### Sort multiple or multidimensional arrays|
|public static |<a href="#walk()">walk</a>|### Apply a user function to every member of an array|
|public static |<a href="#walkrecursive()">walkRecursive</a>|### Apply a user function recursively to every member of an array|
|public static |<a href="#countvalues()">countValues</a>|### Counts the occurrences of each distinct value in an array|
|public static |<a href="#fill()">fill</a>|### Fill an array with values|
|public static |<a href="#fillkeys()">fillKeys</a>|### Fill an array with values, specifying keys|
|public static |<a href="#foldkeys()">foldKeys</a>|### Changes the case of all keys in an array|
|public static |<a href="#chunk()">chunk</a>|### ### Split an array into chunks|
|public static |<a href="#column()">column</a>|### Return the values from a single column in the input array|
|public static |<a href="#combine()">combine</a>|### Creates an array by using one array for keys and another for its values|
|public static |<a href="#difference()">difference</a>|### Computes the difference of arrays using values for comparison|
|public static |<a href="#differencefunc()">differenceFunc</a>|### Computes the difference of arrays using values for comparison by using a callback for comparison|
|public static |<a href="#differencekey()">differenceKey</a>|### Computes the difference of arrays using keys for comparison|
|public static |<a href="#differencekeyfunc()">differenceKeyFunc</a>|### Computes the difference of arrays using keys for comparison by using a callback for data comparison|
|public static |<a href="#differenceassoc()">differenceAssoc</a>|### Computes the difference of arrays with additional index check|
|public static |<a href="#differenceassocfuncvalue()">differenceAssocFuncValue</a>|### Computes the difference of arrays with additional index check by using a callback for value comparison|
|public static |<a href="#differenceassocfunckey()">differenceAssocFuncKey</a>|### Computes the difference of arrays with additional index check by using a callback for key comparison|
|public static |<a href="#differenceassocfunckeyvalue()">differenceAssocFuncKeyValue</a>|### Computes the difference of arrays with additional index check by using a callback for key-value comparison|
|public static |<a href="#intersect()">intersect</a>|### Computes the intersection of arrays using values for comparison|
|public static |<a href="#intersectfunc()">intersectFunc</a>|### Computes the intersection of arrays using values for comparison by using a callback for data comparison|
|public static |<a href="#intersectkey()">intersectKey</a>|### Computes the intersection of arrays using keys for comparison|
|public static |<a href="#intersectkeyfunc()">intersectKeyFunc</a>|### Computes the intersection of arrays using keys for comparison by using a callback for data comparison|
|public static |<a href="#intersectassoc()">intersectAssoc</a>|### Computes the intersection of arrays with additional index check|
|public static |<a href="#intersectassocfuncvalue()">intersectAssocFuncValue</a>|### Computes the intersection of arrays with additional index check by using a callback for value comparison|
|public static |<a href="#intersectassocfunckey()">intersectAssocFuncKey</a>|### Computes the intersection of arrays with additional index check by using a callback for key comparison|
|public static |<a href="#intersectassocfunckeyvalue()">intersectAssocFuncKeyValue</a>|### Computes the intersection of arrays with additional index check by using a callback for key-value comparison|
|public static |<a href="#filter()">filter</a>|### Filter elements in an array|
|public static |<a href="#flip()">flip</a>|### Exchanges all keys with their associated values in an array|
|public static |<a href="#keys()">keys</a>|### Return all the keys or a subset of the keys of an array|
|public static |<a href="#values()">values</a>|### Return all the values from an array|
|public static |<a href="#map()">map</a>|### Applies the callback to the elements of the given arrays|
|public static |<a href="#merge()">merge</a>|### Merges the elements of one or more arrays together|
|public static |<a href="#mergerecursive()">mergeRecursive</a>|### Merge two or more arrays recursively|
|public static |<a href="#pad()">pad</a>|### Pad array to the specified length with a value|
|public static |<a href="#replace()">replace</a>|### Replaces elements from passed arrays into the first array|
|public static |<a href="#replacerecursive()">replaceRecursive</a>|### Replace two or more arrays recursively|
|public static |<a href="#reverse()">reverse</a>|### Reverse the order of array items|
|public static |<a href="#slice()">slice</a>|### Extract a slice of the array|
|public static |<a href="#splice()">splice</a>|### Remove a portion of the array and replace it with something else|
|public static |<a href="#unique()">unique</a>|### Removes duplicate values from an array|
|public static |<a href="#range()">range</a>|### Create an array containing a range of elements|
|public static |<a href="#random()">random</a>|### Pick one or more random keys out of an array|
|public static |<a href="#reduce()">reduce</a>|### Iteratively reduce the array to a single value using a callback function|
|public static |<a href="#pop()">pop</a>|### Pop the element off the end of array|
|public static |<a href="#push()">push</a>|### Push elements onto the end of array|
|public static |<a href="#shift()">shift</a>|### Removes an item at the beginning of an array|
|public static |<a href="#unshift()">unshift</a>|### Prepend one or more elements to the beginning of an array|
|public static |<a href="#firstkey()">firstKey</a>|### Get first key from an array|
|public static |<a href="#lastkey()">lastKey</a>|### Get last key from array|
|public static |<a href="#product()">product</a>|### Calculate the product of values in an array|
|public static |<a href="#sum()">sum</a>|### Calculate the sum of values in an array|
|public static |<a href="#search()">search</a>|### Searches the array for a given value and returns the first corresponding key if successful|
|public static |<a href="#shuffle()">shuffle</a>|### Shuffle array|
|public static |<a href="#sort()">sort</a>|### Sorts array|
|public static |<a href="#sortbykey()">sortByKey</a>|### Sorts array by key|
|public static |<a href="#sortby()">sortBy</a>|### Sorts an array by values using a user-defined comparison function|
|public static |<a href="#sortkeyby()">sortKeyBy</a>|### Sorts array by key using a user-defined comparison function|

## method: keyExist {id="keyexist()"}

<code-block lang="php">
    <![CDATA[public static Arr::keyExist(array-key $key, array $array):bool]]>
</code-block>













### ### Checks if the given key or index exists in the array

<p><format style="italic">Returns true if the given key is set in the array. Key can be any value possible for an array index.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L126">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L126">
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
        <list><li>array-key <format style="bold">$key</format> - <format style="italic">
Key to check.
</format></li><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array with keys to check.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>bool - <format style="italic">True if key exists in an array, false otherwise.</format></li></list>
    </def>
</deflist>
## method: inArray {id="inarray()"}

<code-block lang="php">
    <![CDATA[public static Arr::inArray(mixed $value, array $array):bool]]>
</code-block>













### ### Checks if a value exists in an array



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L148">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L148">
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
        <list><li>mixed <format style="bold">$value</format> - <format style="italic">
The searched value.
note: If a needle is a string, the comparison is done in a case-sensitive manner.
</format></li><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
The array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>bool - <format style="italic">True if value is found in the array, false otherwise.</format></li></list>
    </def>
</deflist>
## method: isList {id="islist()"}

<code-block lang="php">
    <![CDATA[public static Arr::isList(array $array):bool]]>
</code-block>













### ### Checks whether a given array is a list

<p><format style="italic">Determines if the given array is a list. An array is considered a list if its keys consist of consecutive
numbers from 0 to count($array)-1.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L172">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L172">
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
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
The array being evaluated.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>bool - <format style="italic"><code>($array is list ? true: false)</code> True if an array is a list, false otherwise.</format></li></list>
    </def>
</deflist>
## method: multiSort {id="multisort()"}

<code-block lang="php">
    <![CDATA[public static Arr::multiSort(array $array):bool]]>
</code-block>













### ### Sort multiple or multidimensional arrays



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L198">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L198">
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
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, array<array-key, mixed>> ]]></code>
A multidimensional array being sorted.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method throws:">
        <list><li><a href="Error.md">\Error</a> - <format style="italic">Failed to sort a multi-sort array.</format></li><li><a href="ValueError.md">\ValueError</a> - <format style="italic">If array sizes are inconsistent.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>bool - <format style="italic">True on success.</format></li></list>
    </def>
</deflist>
## method: walk {id="walk()"}

<code-block lang="php">
    <![CDATA[public static Arr::walk(array &$array, callable $callback):true]]>
</code-block>













### ### Apply a user function to every member of an array

<p><format style="italic">Applies the user-defined callback function to each element of the array $array. Method is not affected by the
internal array pointer of an array. Method will walk through the entire array regardless of pointer position.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L234">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L234">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to apply a user function.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (TValue $value, TKey $key):mixed</code>
Typically, function name takes on two parameters. The array parameter's value is the first, and the key/index
second. If a function name needs to be working with the actual values of the array, specify the first
parameter of function name as a reference. Then, any changes made to those elements will be made in the
original array itself. Users may not change the array itself from the callback function, e.g., add/delete
elements, unset elements, etc.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method throws:">
        <list><li><a href="ArgumentCountError.md">\ArgumentCountError</a> - <format style="italic">If the $callback function requires more than two parameters.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>true - <format style="italic">True on success.</format></li></list>
    </def>
</deflist>
## method: walkRecursive {id="walkrecursive()"}

<code-block lang="php">
    <![CDATA[public static Arr::walkRecursive(array &$array, callable $callback):true]]>
</code-block>













### ### Apply a user function recursively to every member of an array

<p><format style="italic">Applies the user-defined callback function to each element of the array. This function will recurse into
deeper arrays.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L267">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L267">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to apply a user function.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (TValue $value, TKey $key):mixed</code>
Typically, function name takes on two parameters. The array parameter's value is the first, and the key/index
second. If a function name needs to be working with the actual values of the array, specify the first
parameter of function name as a reference. Then, any changes made to those elements will be made in the
original array itself. Users may not change the array itself from the callback function. E.g., Add/delete
elements, unset elements, etc.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>true - <format style="italic">True on success.</format></li></list>
    </def>
</deflist>
## method: countValues {id="countvalues()"}

<code-block lang="php">
    <![CDATA[public static Arr::countValues(array $array):array]]>
</code-block>













### ### Counts the occurrences of each distinct value in an array

<p><format style="italic">Returns an array using the values of $array (which must be int-s or strings) as keys and their frequency in an
$array as values.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L294">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L294">
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
        <list><li>TValue of array-key</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
The array of values to count.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<array-key, positive-int> ]]></code> An associative array of values from
input as keys and their count as value.</format></li></list>
    </def>
</deflist>
## method: fill {id="fill()"}

<code-block lang="php">
    <![CDATA[public static Arr::fill(mixed $value, int $start_index, int $length):array]]>
</code-block>













### ### Fill an array with values

<p><format style="italic">Fills an array with $length entries of the value of the $value parameter, keys starting at the $start_index
parameter.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L326">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L326">
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
        <list><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>mixed <format style="bold">$value</format> - <format style="italic">
<code>TValue</code>
Value to use for filling.
</format></li><li>int <format style="bold">$start_index</format> - <format style="italic">
The first index of the returned array.
</format></li><li>int <format style="bold">$length</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method throws:">
        <list><li><a href="ValueError.md">\ValueError</a> - <format style="italic">If $length is out of range.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<int, TValue> ]]></code> Filled array.</format></li></list>
    </def>
</deflist>
## method: fillKeys {id="fillkeys()"}

<code-block lang="php">
    <![CDATA[public static Arr::fillKeys(array $keys, mixed $value):array]]>
</code-block>













### ### Fill an array with values, specifying keys

<p><format style="italic">Fills an array with the value of the $value parameter, using the values of the $keys array as keys.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L358">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L358">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$keys</format> - <format style="italic">
<code><![CDATA[ array<array-key, array-key> ]]></code>
Array of values that will be used as keys.
Illegal values for a key will be converted to string.
</format></li><li>mixed <format style="bold">$value</format> - <format style="italic">
<code>TValue</code>
Value to use for filling.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method throws:">
        <list><li><a href="Error.md">\Error</a> - <format style="italic">If key could not be converted to string.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> The filled array.</format></li></list>
    </def>
</deflist>
## method: foldKeys {id="foldkeys()"}

<code-block lang="php">
    <![CDATA[public static Arr::foldKeys(array $array, \FireHub\Core\Support\Enums\String\CaseFolding $case = CaseFolding::LOWER):array]]>
</code-block>













### ### Changes the case of all keys in an array

<p><format style="italic">Returns an array with all keys from array lowercased or uppercased. Numbered indices are left as is.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L393">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L393">
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
        <list><li><a href="CaseFolding.md#lower">\FireHub\Core\Support\Enums\String\CaseFolding::LOWER</a>  - <format style="italic">As default parameter.</format></li><li><a href="CaseFolding.md#upper">\FireHub\Core\Support\Enums\String\CaseFolding::UPPER</a>  - <format style="italic">To fold keys to uppercase.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has templates:">
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to work on.
</format></li><li><a href="CaseFolding.md">\FireHub\Core\Support\Enums\String\CaseFolding</a> <format style="bold">$case</format> = CaseFolding::LOWER - <format style="italic">[optional] 
<code>\FireHub\Core\Support\Enums\String\CaseFolding::LOWER|\FireHub\Core\Support\Enums\String\CaseFolding::UPPER</code>
Either LOWER or UPPER case folding.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array with its keys lower or uppercased.</format></li></list>
    </def>
</deflist>
## method: chunk {id="chunk()"}

<code-block lang="php">
    <![CDATA[public static Arr::chunk(array $array, positive-int $length, bool $preserve_keys = false):array]]>
</code-block>













### ### ### Split an array into chunks

<p><format style="italic">Chunks an array into arrays with $length elements. The last chunk may contain less than $length elements.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L428">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L428">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array.
</format></li><li>positive-int <format style="bold">$length</format> - <format style="italic">
The size of each chunk.
If the length is less than 1, it will default to 1.
</format></li><li>bool <format style="bold">$preserve_keys</format> = false - <format style="italic">[optional] 
When set to true, keys will be preserved.
Default is false that will reindex the chunk numerically.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method throws:">
        <list><li><a href="ValueError.md">\ValueError</a> - <format style="italic">If length is less than 1.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ ($preserve_keys is true ? list<array<TKey, TValue>> : list<list<TValue>>) ]]></code>
Multidimensional numerically indexed array, starting with zero, with each dimension containing $length elements.</format></li></list>
    </def>
</deflist>
## method: column {id="column()"}

<code-block lang="php">
    <![CDATA[public static Arr::column(array $array, int|string $key, null|int|string $index = null):array]]>
</code-block>













### ### Return the values from a single column in the input array

<p><format style="italic">Returns the values from a single column of the $array, identified by the $key. Optionally, an argument key may
be provided to $index the values in the returned array by the values from the index argument column of the
input array.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L470">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L470">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, array<TKey, TValue>> ]]></code>
A multidimensional array (record set) from which to pull a column of values. If an array of objects is provided,
then public properties can be directly pulled. In order for protected or private properties to be pulled,
the class must implement both the __get() and __isset() magic methods.
</format></li><li>int or string <format style="bold">$key</format> - <format style="italic">
<code>TKey</code>
The column of values to return. This value may be an integer key of the column you wish to retrieve, or it may
be a string key name for an associative array or property name. It may also be null to return complete arrays or
objects (this is useful together with $index to reindex the array).
</format></li><li>null or int or string <format style="bold">$index</format> = null - <format style="italic">[optional] 
<code>null|TKey</code>
The column to use as the index/keys for the returned array. This value may be the integer key of the column,
or it may be the string key name. The value is cast as usual for array keys.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ ($index is null ? array<TValue> : array<TValue, TValue>) ]]></code> Array of values
representing a single column from the input array.</format></li></list>
    </def>
</deflist>
## method: combine {id="combine()"}

<code-block lang="php">
    <![CDATA[public static Arr::combine(array $keys, array $values):array]]>
</code-block>













### ### Creates an array by using one array for keys and another for its values

<p><format style="italic">Creates an array by using the values from the $keys array as keys and the values from the $values array as the
corresponding values.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L503">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L503">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$keys</format> - <format style="italic">
<code><![CDATA[ array<array-key, TKey> ]]></code>
Array of values to be used as keys.
Illegal values for a key will be converted to string.
</format></li><li>array <format style="bold">$values</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
Array of values to be used as values on a combined array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method throws:">
        <list><li><a href="ValueError.md">\ValueError</a> - <format style="italic">If arguments $keys and $values don&#039;t have the same number of elements.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> The combined array.</format></li></list>
    </def>
</deflist>
## method: difference {id="difference()"}

<code-block lang="php">
    <![CDATA[public static Arr::difference(array $array, array ...$excludes):array]]>
</code-block>













### ### Computes the difference of arrays using values for comparison

<p><format style="italic">Compares an array against one or more other arrays and returns the values in array that are not present in any of
the other arrays.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L537">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L537">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
The array to compare from.
</format></li><li>variadic array <format style="bold">$excludes</format> - <format style="italic">[optional] 
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from
$array that are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: differenceFunc {id="differencefunc()"}

<code-block lang="php">
    <![CDATA[public static Arr::differenceFunc(array $array, array $excludes, callable $callback):array]]>
</code-block>













### ### Computes the difference of arrays using values for comparison by using a callback for comparison

<p><format style="italic">Computes the difference of arrays by using a callback function for data comparison. This is unlike
[[Arr#difference()]] which uses an internal function for comparing the data.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L579">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L579">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function must return an integer less than, equal to, or greater than zero if the first argument
is considered to be respectively less than, equal to, or greater than the second.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from $array
that are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: differenceKey {id="differencekey()"}

<code-block lang="php">
    <![CDATA[public static Arr::differenceKey(array $array, array ...$excludes):array]]>
</code-block>













### ### Computes the difference of arrays using keys for comparison

<p><format style="italic">Compares the keys from array against the keys from arrays and returns the difference. This function is like
[[Arr#difference()]] except the comparison is done on the keys instead of the values.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L613">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L613">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>variadic array <format style="bold">$excludes</format> - <format style="italic">[optional] 
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> Returns an array containing all the entries from
array whose keys are absent from all the other arrays.</format></li></list>
    </def>
</deflist>
## method: differenceKeyFunc {id="differencekeyfunc()"}

<code-block lang="php">
    <![CDATA[public static Arr::differenceKeyFunc(array $array, array $excludes, callable $callback):array]]>
</code-block>













### ### Computes the difference of arrays using keys for comparison by using a callback for data comparison

<p><format style="italic">Compares the keys from array against the keys from arrays and returns the difference. This function is like
[[Arr#difference()]] except the comparison is done on the keys instead of the values.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L654">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L654">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from $array
that are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: differenceAssoc {id="differenceassoc()"}

<code-block lang="php">
    <![CDATA[public static Arr::differenceAssoc(array $array, array ...$excludes):array]]>
</code-block>













### ### Computes the difference of arrays with additional index check

<p><format style="italic">Compares an array against arrays and returns the difference. Unlike [[Arr#difference()]], the array keys are
also used in the comparison.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L690">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L690">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>variadic array <format style="bold">$excludes</format> - <format style="italic">[optional] 
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from $array
that are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: differenceAssocFuncValue {id="differenceassocfuncvalue()"}

<code-block lang="php">
    <![CDATA[public static Arr::differenceAssocFuncValue(array $array, array $excludes, callable $callback):array]]>
</code-block>













### ### Computes the difference of arrays with additional index check by using a callback for value comparison

<p><format style="italic">Computes the difference of arrays with additional index check, compares data by a callback function.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L731">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L731">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from $array
that are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: differenceAssocFuncKey {id="differenceassocfunckey()"}

<code-block lang="php">
    <![CDATA[public static Arr::differenceAssocFuncKey(array $array, array $excludes, callable $callback):array]]>
</code-block>













### ### Computes the difference of arrays with additional index check by using a callback for key comparison

<p><format style="italic">Compares an array against arrays and returns the difference. Unlike [[Arr#difference()]], the array keys are
used in the comparison. Unlike [[Arr#differenceAssoc()]], a user-supplied callback function is used for the
indices comparison, not internal function.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L773">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L773">
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
        <list><li>TKey</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> Returns an array containing all the entries from
$array that are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: differenceAssocFuncKeyValue {id="differenceassocfunckeyvalue()"}

<code-block lang="php">
    <![CDATA[public static Arr::differenceAssocFuncKeyValue(array $array, array $excludes, callable $callback_value, callable $callback_key):array]]>
</code-block>













### ### Computes the difference of arrays with additional index check by using a callback for key-value comparison

<p><format style="italic">Computes the difference of arrays with additional index check, compares data and indexes by a callback function.
Note that the keys are used in the comparison unlike [[Arr#difference()]] and [[Arr#differenceFunc()]].</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L819">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L819">
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
        <list><li>TKey</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback_value</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function for value.
</format></li><li>callable <format style="bold">$callback_key</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function for key.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from $array
that are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: intersect {id="intersect()"}

<code-block lang="php">
    <![CDATA[public static Arr::intersect(array $array, array ...$arrays):array]]>
</code-block>













### ### Computes the intersection of arrays using values for comparison

<p><format style="italic">Returns an array containing all the values of array that are present in all the arguments. Note that keys are
preserved.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L852">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L852">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array with main values to check.
</format></li><li>variadic array <format style="bold">$arrays</format> - <format style="italic">[optional] 
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare values against.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> The filtered array.</format></li></list>
    </def>
</deflist>
## method: intersectFunc {id="intersectfunc()"}

<code-block lang="php">
    <![CDATA[public static Arr::intersectFunc(array $array, array $excludes, callable $callback):array]]>
</code-block>













### ### Computes the intersection of arrays using values for comparison by using a callback for data comparison

<p><format style="italic">Computes the intersection of arrays, compares data by a callback function.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L892">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L892">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> Arrays containing all the entries from $array that
are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: intersectKey {id="intersectkey()"}

<code-block lang="php">
    <![CDATA[public static Arr::intersectKey(array $array, array ...$arrays):array]]>
</code-block>













### ### Computes the intersection of arrays using keys for comparison

<p><format style="italic">Returns an array containing all the entries of array which have keys that are present in all the arguments.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L921">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L921">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array with main values to check.
</format></li><li>variadic array <format style="bold">$arrays</format> - <format style="italic">[optional] 
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare values against.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> The filtered array.</format></li></list>
    </def>
</deflist>
## method: intersectKeyFunc {id="intersectkeyfunc()"}

<code-block lang="php">
    <![CDATA[public static Arr::intersectKeyFunc(array $array, array $excludes, callable $callback):array]]>
</code-block>













### ### Computes the intersection of arrays using keys for comparison by using a callback for data comparison

<p><format style="italic">Returns an array containing all the values of array which have matching keys that are present in all the
arguments.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L960">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L960">
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
        <list><li>TKey</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from $array that
are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: intersectAssoc {id="intersectassoc()"}

<code-block lang="php">
    <![CDATA[public static Arr::intersectAssoc(array $array, array ...$arrays):array]]>
</code-block>













### ### Computes the intersection of arrays with additional index check

<p><format style="italic">Returns an array containing all the values of array that are present in all the arguments. Note that the keys
are also used in the comparison unlike in [[Arr#intersect()]].</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L993">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L993">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array with main values to check.
</format></li><li>variadic array <format style="bold">$arrays</format> - <format style="italic">[optional] 
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare values against.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> The filtered array.</format></li></list>
    </def>
</deflist>
## method: intersectAssocFuncValue {id="intersectassocfuncvalue()"}

<code-block lang="php">
    <![CDATA[public static Arr::intersectAssocFuncValue(array $array, array $excludes, callable $callback):array]]>
</code-block>













### ### Computes the intersection of arrays with additional index check by using a callback for value comparison

<p><format style="italic">Computes the intersection of arrays with additional index check, compares data by a callback function. Note
that the keys are used in the comparison unlike in [[Arr#intersectFunc()]]. The data is compared by using a
callback function.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1033">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1033">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">$callback 
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from $array that
are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: intersectAssocFuncKey {id="intersectassocfunckey()"}

<code-block lang="php">
    <![CDATA[public static Arr::intersectAssocFuncKey(array $array, array $excludes, callable $callback):array]]>
</code-block>













### ### Computes the intersection of arrays with additional index check by using a callback for key comparison

<p><format style="italic">Computes the intersection of arrays with additional index check, compares data and indexes by separate
callback functions.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1074">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1074">
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
        <list><li>TKey</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from $array that
are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: intersectAssocFuncKeyValue {id="intersectassocfunckeyvalue()"}

<code-block lang="php">
    <![CDATA[public static Arr::intersectAssocFuncKeyValue(array $array, array $excludes, callable $callback_value, callable $callback_key):array]]>
</code-block>













### ### Computes the intersection of arrays with additional index check by using a callback for key-value comparison

<p><format style="italic">Computes the intersection of arrays with additional index check, compares data and indexes by separate
callback functions.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1119">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1119">
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
        <list><li>TKey</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to compare from.
</format></li><li>array <format style="bold">$excludes</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array to compare against.
</format></li><li>callable <format style="bold">$callback_value</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function for value.
</format></li><li>callable <format style="bold">$callback_key</format> - <format style="italic">
<code>callable (mixed $a, mixed $b):int<-1, 1></code>
The comparison function for key.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> An array containing all the entries from $array that
are not present in any of the other arrays.</format></li></list>
    </def>
</deflist>
## method: filter {id="filter()"}

<code-block lang="php">
    <![CDATA[public static Arr::filter(array $array, null|callable $callback = null, bool $pass_key = false):array]]>
</code-block>













### ### Filter elements in an array

<p><format style="italic">Iterates over each value in the $array passing them to the $callback function. If the $callback function
returns true, the current value from an $array is returned into the result array. Array keys are preserved, and
may result in gaps if the $array was indexed. The result array can be re-indexed using the values() function.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1158">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1158">
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
        <list><li><a href="DataIs.md#null">\FireHub\Core\Support\LowLevel\DataIs::null</a>  - <format style="italic">To find whether a callable parameter is null.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method is used by:">
        <list><li><a href="FileSystem.md#statistics()">\FireHub\Core\Support\LowLevel\FileSystem::statistics()</a>  - <format style="italic">To filter string keys in statistics.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has templates:">
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to iterate over.
</format></li><li>null or callable <format style="bold">$callback</format> = null - <format style="italic">[optional] 
<code>null|callable (TValue, TKey=):bool</code>
The callback function to use.
If no callback is supplied, all empty and false entries of an array will be removed.
</format></li><li>bool <format style="bold">$pass_key</format> = false - <format style="italic">[optional] 
Pass key as the argument to callback.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> Filtered array.</format></li></list>
    </def>
</deflist>
## method: flip {id="flip()"}

<code-block lang="php">
    <![CDATA[public static Arr::flip(array $array):array]]>
</code-block>













### ### Exchanges all keys with their associated values in an array

<p><format style="italic">Returns an array in flip order; i.e., keys from an $array become values and values from an $array become keys.
Note that the values of $array need to be valid keys, i.e., they need to be either int or string. A warning
will be emitted if a value has the wrong type, and the key/value pair in question will not be included in the
result. If a value has several occurrences, the latest key will be used as its value, and all others will be
lost.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1193">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1193">
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
        <list><li>TKey of array-key</li><li>TValue of array-key</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to flip.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> The flipped array.</format></li></list>
    </def>
</deflist>
## method: keys {id="keys()"}

<code-block lang="php">
    <![CDATA[public static Arr::keys(array $array, mixed $filter = null):array]]>
</code-block>













### ### Return all the keys or a subset of the keys of an array

<p><format style="italic">Returns the keys, numeric and string, from the $array. If a $filter is specified, then only the keys for that
value are returned. Otherwise, all the keys from the array are returned.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1218">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1218">
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
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array containing keys to return.
</format></li><li>mixed <format style="bold">$filter</format> = null - <format style="italic">[optional] 
If specified, then only keys containing these values are returned.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ list<mixed> ]]></code> An array of all the keys in input.</format></li></list>
    </def>
</deflist>
## method: values {id="values()"}

<code-block lang="php">
    <![CDATA[public static Arr::values(array $array):array]]>
</code-block>













### ### Return all the values from an array

<p><format style="italic">Returns all the values from the array and indexes the array numerically.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1243">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1243">
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
        <list><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
The array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TValue> ]]></code> An indexed array of values.</format></li></list>
    </def>
</deflist>
## method: map {id="map()"}

<code-block lang="php">
    <![CDATA[public static Arr::map(array $array, callable $callback):array]]>
</code-block>













### ### Applies the callback to the elements of the given arrays

<p><format style="italic">Returns an array containing the results of applying the $callback to the corresponding value of an $array used as
arguments for the callback. The number of parameters that the $callback function accepts should match the
number of arrays passed to map(). Excess input arrays are ignored. An ArgumentCountError is thrown if an
insufficient number of arguments is provided.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1279">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1279">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
Array to run through the callback function.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>null|callable (TValue $value):mixed</code>
Callback function to run for each element in each array.
Null can be passed as a value to $callback to perform a zip operation on multiple arrays.
If only an array is provided, map() will return the input array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method throws:">
        <list><li><a href="ArgumentCountError.md">\ArgumentCountError</a> - <format style="italic">If an insufficient number of arguments is provided.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, mixed> ]]></code> Array containing all the elements of arr1 after
applying the callback function.</format></li></list>
    </def>
</deflist>
## method: merge {id="merge()"}

<code-block lang="php">
    <![CDATA[public static Arr::merge(array ...$arrays):array]]>
</code-block>













### ### Merges the elements of one or more arrays together

<p><format style="italic">Merges the elements of one or more arrays together so that the values of one are appended to the end of the
previous one. It returns the resulting array. If the input arrays have the same string keys, then the later
value for that key will overwrite the previous one. If, however, the arrays contain numeric keys, the later
value will not overwrite the original value, but will be appended. Values in the input arrays with numeric
keys will be renumbered with incrementing keys starting from zero in the result array.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1312">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1312">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>variadic array <format style="bold">$arrays</format> - <format style="italic">[optional] 
<code><![CDATA[ array<TKey, TValue> ]]></code>
Variable list of arrays to merge.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> The resulting array.</format></li></list>
    </def>
</deflist>
## method: mergeRecursive {id="mergerecursive()"}

<code-block lang="php">
    <![CDATA[public static Arr::mergeRecursive(array ...$arrays):array]]>
</code-block>













### ### Merge two or more arrays recursively

<p><format style="italic">Merges the elements of one or more arrays together so that the values of one are appended to the end of the
previous one. It returns the resulting array. If the input arrays have the same string keys, then the values
for these keys are merged into an array. This is done recursively, so that if one of the values is an array
itself, the function will merge it with a corresponding entry in another array too. If, however, the arrays
have the same numeric key, the later value will not overwrite the original value, but will be appended.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1337">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1337">
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
        <list><li>variadic array <format style="bold">$arrays</format> - <format style="italic">[optional] 
<code><![CDATA[ array<array-key, mixed> ]]></code>
Variable list of arrays to recursively merge.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<array-key, mixed> ]]></code> The resulting array.</format></li></list>
    </def>
</deflist>
## method: pad {id="pad()"}

<code-block lang="php">
    <![CDATA[public static Arr::pad(array $array, int $length, mixed $value):array]]>
</code-block>













### ### Pad array to the specified length with a value

<p><format style="italic">Returns a copy of the array padded to size specified by $length with value $value. If the length is positive,
then the array is padded on the right if it's negative then on the left. If the absolute value of length is
less than or equal to the length of the array, then no padding takes place. It is possible to add at most
1048576 elements at a time.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1371">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1371">
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
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
Initial array of values to pad.
</format></li><li>int <format style="bold">$length</format> - <format style="italic">
New size of the array.
If the length is positive, then the array is padded on the right if it's negative then on the left.
If the absolute value of length is less than or equal to the length of the array, then no padding takes place.
</format></li><li>mixed <format style="bold">$value</format> - <format style="italic">
Value to pad if input is less than length.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<array-key, mixed> ]]></code> A copy of the input padded to size specified by $length with value $value.</format></li></list>
    </def>
</deflist>
## method: replace {id="replace()"}

<code-block lang="php">
    <![CDATA[public static Arr::replace(array $array, array ...$replacements):array]]>
</code-block>













### ### Replaces elements from passed arrays into the first array

<p><format style="italic">Replaces the values of $array with values having the same keys in each of the following arrays. If a key from
the first array exists in the second array, its value will be replaced by the value from the second array. If
the key exists in the second array, and not the first, it will be created in the first array. If a key only
exists in the first array, it will be left as is. If several arrays are passed for replacement, they will be
processed in order, the later arrays overwriting the previous values. Method is not recursive, it will replace
values in the first array by whatever type is in the second array.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1404">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1404">
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
        <list><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TValue> ]]></code>
The array in which elements are replaced.
</format></li><li>variadic array <format style="bold">$replacements</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TValue> ]]></code> The resulting array.</format></li></list>
    </def>
</deflist>
## method: replaceRecursive {id="replacerecursive()"}

<code-block lang="php">
    <![CDATA[public static Arr::replaceRecursive(array $array, array ...$replacements):array]]>
</code-block>













### ### Replace two or more arrays recursively

<p><format style="italic">Replaces the values of $array with the same values from all the following arrays. If a key from the first
array exists in the second array, its value will be replaced by the value from the second array. If the key
exists in the second array, and not the first, it will be created in the first array. If a key only exists in
the first array, it will be left as is. If several arrays are passed for replacement, they will be processed
in order, the later array overwriting the previous values. When the value in the first array is scalar, it
will be replaced by the value in the second array, may it be scalar or array. When the value in the first
array and the second array are both arrays, replaceRecursive() will replace their respective values recursively.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1438">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1438">
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
        <list><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TValue> ]]></code>
The array in which elements are replaced.
</format></li><li>variadic array <format style="bold">$replacements</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TValue> ]]></code> The resulting array.</format></li></list>
    </def>
</deflist>
## method: reverse {id="reverse()"}

<code-block lang="php">
    <![CDATA[public static Arr::reverse(array $array, bool $preserve_keys = false):array]]>
</code-block>













### ### Reverse the order of array items

<p><format style="italic">Takes an input array and returns a new array with the order of the elements reversed.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1466">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1466">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
Array to reverse.
</format></li><li>bool <format style="bold">$preserve_keys</format> = false - <format style="italic">[optional] 
Whether you want to preserve keys from an original array or not.
Non-numeric keys are not affected by this setting and will always be preserved.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ ($preserve_keys is true ? array<TKey, TValue> : array<array-key, TValue>) ]]></code> The reversed array.</format></li></list>
    </def>
</deflist>
## method: slice {id="slice()"}

<code-block lang="php">
    <![CDATA[public static Arr::slice(array $array, int $offset, null|int $length = null, bool $preserve_keys = false):array]]>
</code-block>













### ### Extract a slice of the array



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1501">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1501">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The input array.
</format></li><li>int <format style="bold">$offset</format> - <format style="italic">
If the offset is non-negative, the sequence will start at that offset in the array.
If the offset is negative, the sequence will start that far from the end of the array.
</format></li><li>null or int <format style="bold">$length</format> = null - <format style="italic">[optional] 
If length is given and is positive, then the sequence will have that many elements in it.
If length is given and is negative, then the sequence will stop that many elements from the end of the array.
If it is omitted, then the sequence will have everything from offset up until the end of the array.
</format></li><li>bool <format style="bold">$preserve_keys</format> = false - <format style="italic">[optional] 
Note that array_slice will reorder and reset the array indices by default.
You can change this behavior by setting preserve_keys to true.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ ($preserve_keys is true ? array<TKey, TValue> : array<TKey|int, TValue>) ]]></code> Sliced array.</format></li></list>
    </def>
</deflist>
## method: splice {id="splice()"}

<code-block lang="php">
    <![CDATA[public static Arr::splice(array &$array, int $offset, null|int $length = null, mixed $replacement = []):array]]>
</code-block>













### ### Remove a portion of the array and replace it with something else

<p><format style="italic">Removes the elements designated by offset and length from the array $array, and replaces them with the elements
of the replacement array, if supplied.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1548">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1548">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
Array to splice.
</format></li><li>int <format style="bold">$offset</format> - <format style="italic">
If the offset is positive, then the start of the removed portion is at that offset from the beginning of the
input array.
If the offset is negative, then it starts that far from the end of the input array.
</format></li><li>null or int <format style="bold">$length</format> = null - <format style="italic">[optional] 
If length is omitted, removes everything from offset to the end of the array.
If length is specified and is positive, then that many elements will be removed.
If length is specified and is negative, then the end of the removed portion will be that many elements from
the end of the array.
</format></li><li>mixed <format style="bold">$replacement</format> = [] - <format style="italic">[optional] 
If a replacement array is specified, then the removed elements will be replaced with elements from this array.
If offset and length are such that nothing is removed, then the elements from the replacement array or array
are inserted in the place specified by the offset.
Keys in a replacement array are not preserved.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey|int, TValue> ]]></code> Spliced array.</format></li></list>
    </def>
</deflist>
## method: unique {id="unique()"}

<code-block lang="php">
    <![CDATA[public static Arr::unique(array $array):array]]>
</code-block>













### ### Removes duplicate values from an array

<p><format style="italic">Takes an input array and returns a new array without duplicate values.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1575">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1575">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
The array to remove duplicates.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<TKey, TValue> ]]></code> The filtered array.</format></li></list>
    </def>
</deflist>
## method: range {id="range()"}

<code-block lang="php">
    <![CDATA[public static Arr::range(int|float|string $start, int|float|string $end, int|float $step = 1):array]]>
</code-block>













### ### Create an array containing a range of elements



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1611">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1611">
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
        <list><li>int or float or string <format style="bold">$start</format> - <format style="italic">
First value of the sequence.
</format></li><li>int or float or string <format style="bold">$end</format> - <format style="italic">
The sequence is ended upon reaching the end value.
</format></li><li>int or float <format style="bold">$step</format> = 1 - <format style="italic">[optional] 
If a step value is given, it will be used as the increment between elements in the sequence. Step should be
given as a positive number. If not specified, a step will default to 1.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method throws:">
        <list><li><a href="ValueError.md">\ValueError</a> - <format style="italic">If &amp;start or &amp;end is a string implicitly cast to int because the other boundary value
is a number, $start or $end is a non-numeric string with more than one byte or &amp;start or &amp;end is the empty
string.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array - <format style="italic"><code><![CDATA[ array<int, int|float|string> ]]></code> An array of elements from start to end,
inclusive, false otherwise.</format></li></list>
    </def>
</deflist>
## method: random {id="random()"}

<code-block lang="php">
    <![CDATA[public static Arr::random(array $array, int $number = 1):array|int|string]]>
</code-block>













### ### Pick one or more random keys out of an array

<p><format style="italic">Picks one or more random entries out of an array, and returns the key (or keys) of the random entries.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1642">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1642">
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
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
The input array.
</format></li><li>int <format style="bold">$number</format> = 1 - <format style="italic">[optional] 
Specifies how many entries should be picked.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method throws:">
        <list><li><a href="ValueError.md">\ValueError</a> - <format style="italic">If $number is not between one and the number of elements in argument.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>array or int or string - <format style="italic"><code><![CDATA[ array<int, array-key>|int|string ]]></code> When picking only one entry,
array_rand() returns the key for a random entry. Otherwise, an array of keys for the random entries is returned.</format></li></list>
    </def>
</deflist>
## method: reduce {id="reduce()"}

<code-block lang="php">
    <![CDATA[public static Arr::reduce(array $array, callable $callback, mixed $initial = null):mixed]]>
</code-block>













### ### Iteratively reduce the array to a single value using a callback function

<p><format style="italic">Iteratively applies the $callback function to the elements of the $array, to reduce the array to a single value.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1670">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1670">
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
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
The input array.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code>callable (mixed $carry, mixed $item):mixed</code>
The callable function.
</format></li><li>mixed <format style="bold">$initial</format> = null - <format style="italic">[optional] 
If the optional initial is available, it will be used at the beginning of the process,
or as a final result in case the array is empty.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>mixed - <format style="italic">Resulting value or null if the array is empty and initial is not passed.</format></li></list>
    </def>
</deflist>
## method: pop {id="pop()"}

<code-block lang="php">
    <![CDATA[public static Arr::pop(array &$array):mixed]]>
</code-block>













### ### Pop the element off the end of array

<p><format style="italic">Pops and returns the last element value of th $array, shortening the $array by one element.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1696">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1696">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method is used by:">
        <list><li><a href="Callback.md#classcomponents()">\FireHub\Core\Initializers\Autoload\Callback::classComponents()</a>  - <format style="italic">To remove classname from namespace.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has templates:">
        <list><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
The array to get the value from.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>mixed - <format style="italic"><code>TValue|null</code> The last value of an array. If an array is empty (or is not an array), null will be returned.</format></li></list>
    </def>
</deflist>
## method: push {id="push()"}

<code-block lang="php">
    <![CDATA[public static Arr::push(array &$array, \FireHub\Core\Support\LowLevel\TValue ...$values):int]]>
</code-block>













### ### Push elements onto the end of array

<p><format style="italic">Method treats an array as a stack, and pushes the passed variables onto the end of array. The length of array
increases by the number of variables pushed.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1726">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1726">
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
        <list><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
The input array.
</format></li><li>variadic <a href="TValue.md">\FireHub\Core\Support\LowLevel\TValue</a> <format style="bold">$values</format> - <format style="italic">[optional] 
The values to push onto the end of the array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int - <format style="italic">The new number of elements in the array.</format></li></list>
    </def>
</deflist>
## method: shift {id="shift()"}

<code-block lang="php">
    <![CDATA[public static Arr::shift(array &$array):mixed]]>
</code-block>













### ### Removes an item at the beginning of an array

<p><format style="italic">Shifts the first value of the array off and returns it, shortening the array by one element and moving
everything down. All numerical array keys will be modified to start counting from zero while literal keys won't
be affected.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1754">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1754">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method is used by:">
        <list><li><a href="FireHub.md#autoload()">\FireHub\Core\FireHub::autoload()</a>  - <format style="italic">To remove firehub and core form namespace.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has templates:">
        <list><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
Array to shift.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>mixed - <format style="italic"><code>TValue|null</code> The shifted value, or null if an array is empty or is not an array.</format></li></list>
    </def>
</deflist>
## method: unshift {id="unshift()"}

<code-block lang="php">
    <![CDATA[public static Arr::unshift(array &$array, \FireHub\Core\Support\LowLevel\TValue ...$values):int]]>
</code-block>













### ### Prepend one or more elements to the beginning of an array

<p><format style="italic">Method prepends passed elements to the front of the array.
Note that the list of elements is prepended as a whole, so that the prepended elements stay in the same order.
All numerical array keys will be modified to start counting from zero while literal keys won't be changed.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1784">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1784">
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
        <list><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
The input array.
</format></li><li>variadic <a href="TValue.md">\FireHub\Core\Support\LowLevel\TValue</a> <format style="bold">$values</format> - <format style="italic">[optional] 
The values to prepend.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int - <format style="italic">The new number of elements in the array.</format></li></list>
    </def>
</deflist>
## method: firstKey {id="firstkey()"}

<code-block lang="php">
    <![CDATA[public static Arr::firstKey(array $array):null|int|string]]>
</code-block>













### ### Get first key from an array

<p><format style="italic">Get the first key of the given $array without affecting the internal array pointer.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1804">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1804">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method is used by:">
        <list><li><a href="FireHub.md#autoload()">\FireHub\Core\FireHub::autoload()</a>  - <format style="italic">To check if the first key is firehub and core.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>null or int or string - <format style="italic">First key from $array or null if an array is empty.</format></li></list>
    </def>
</deflist>
## method: lastKey {id="lastkey()"}

<code-block lang="php">
    <![CDATA[public static Arr::lastKey(array $array):null|int|string]]>
</code-block>













### ### Get last key from array

<p><format style="italic">Get the last key of the given $array without affecting the internal array pointer.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1824">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1824">
                    View blame
                </a>
            </def></deflist>
<deflist>
    <def title="Version history:">
        <list><li>1.0.0</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method is used by:">
        <list><li><a href="Callback.md#classcomponents()">\FireHub\Core\Initializers\Autoload\Callback::classComponents()</a>  - <format style="italic">To get classname.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
An array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>null or int or string - <format style="italic">Last key from $array or null if an array is empty.</format></li></list>
    </def>
</deflist>
## method: product {id="product()"}

<code-block lang="php">
    <![CDATA[public static Arr::product(array $array):int|float]]>
</code-block>













### ### Calculate the product of values in an array

<p><format style="italic">Returns the product of values in an array.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1844">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1844">
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
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
The array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int or float - <format style="italic">The product as an integer or float.</format></li></list>
    </def>
</deflist>
## method: sum {id="sum()"}

<code-block lang="php">
    <![CDATA[public static Arr::sum(array $array):int|float]]>
</code-block>













### ### Calculate the sum of values in an array



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1862">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1862">
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
        <list><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
The input array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int or float - <format style="italic">The sum of values as an integer or float; 0 if the array is empty.</format></li></list>
    </def>
</deflist>
## method: search {id="search()"}

<code-block lang="php">
    <![CDATA[public static Arr::search(mixed $value, array $array):int|string|false]]>
</code-block>













### ### Searches the array for a given value and returns the first corresponding key if successful



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1892">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1892">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>mixed <format style="bold">$value</format> - <format style="italic">
The searched value.
If $value is a string, the comparison is done in a case-sensitive manner.
</format></li><li>array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, mixed> ]]></code>
Array to search.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>int or string or false - <format style="italic"><code>TKey|false</code> The key for value if it is found in the array, false otherwise.</format></li></list>
    </def>
</deflist>
## method: shuffle {id="shuffle()"}

<code-block lang="php">
    <![CDATA[public static Arr::shuffle(array &$array):true]]>
</code-block>













### ### Shuffle array

<p><format style="italic">This function shuffles (randomizes the order of the elements in) an array.</format></p>

<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1921">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1921">
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
        <list><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<array-key, TValue> ]]></code>
The array.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>true - <format style="italic">Always returns true.</format></li></list>
    </def>
</deflist>
## method: sort {id="sort()"}

<code-block lang="php">
    <![CDATA[public static Arr::sort(array &$array, \FireHub\Core\Support\Enums\Order $order = Order::ASC, \FireHub\Core\Support\Enums\Sort $flag = Sort::SORT_REGULAR, bool $preserve_keys = false):true]]>
</code-block>











<tip>
                <p><format style="bold" color="DarkBlue">Todo:</format></p>
                <p><format color="DarkBlue">Replace phpstan error when update is available.</format></p>
            </tip>

### ### Sorts array



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1959">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1959">
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
        <list><li><a href="Order.md#asc">\FireHub\Core\Support\Enums\Order::ASC</a>  - <format style="italic">As default parameter.</format></li><li><a href="Sort.md#sort_regular">\FireHub\Core\Support\Enums\Sort::SORT_REGULAR</a>  - <format style="italic">As default parameter.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has templates:">
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
Array to sort.
</format></li><li><a href="Order.md">\FireHub\Core\Support\Enums\Order</a> <format style="bold">$order</format> = Order::ASC - <format style="italic">[optional] 
Order type.
</format></li><li><a href="Sort.md">\FireHub\Core\Support\Enums\Sort</a> <format style="bold">$flag</format> = Sort::SORT_REGULAR - <format style="italic">[optional] 
Sort flag.
</format></li><li>bool <format style="bold">$preserve_keys</format> = false - <format style="italic">[optional] 
Whether you want to preserve keys from an original array or not.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>true - <format style="italic">Always true.</format></li></list>
    </def>
</deflist>
## method: sortByKey {id="sortbykey()"}

<code-block lang="php">
    <![CDATA[public static Arr::sortByKey(array<int|string,mixed> &$array, \FireHub\Core\Support\Enums\Order $order = Order::ASC, \FireHub\Core\Support\Enums\Sort $flag = Sort::SORT_REGULAR):true]]>
</code-block>













### ### Sorts array by key



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1999">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L1999">
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
        <list><li><a href="Order.md#asc">\FireHub\Core\Support\Enums\Order::ASC</a>  - <format style="italic">As default parameter.</format></li><li><a href="Sort.md#sort_regular">\FireHub\Core\Support\Enums\Sort::SORT_REGULAR</a>  - <format style="italic">As default parameter.</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has templates:">
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array&lt;int or string,mixed&gt; <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
Array to sort.
</format></li><li><a href="Order.md">\FireHub\Core\Support\Enums\Order</a> <format style="bold">$order</format> = Order::ASC - <format style="italic">[optional] 
Order type.
</format></li><li><a href="Sort.md">\FireHub\Core\Support\Enums\Sort</a> <format style="bold">$flag</format> = Sort::SORT_REGULAR - <format style="italic">[optional] 
Sort flag.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>true - <format style="italic">Always true.</format></li></list>
    </def>
</deflist>
## method: sortBy {id="sortby()"}

<code-block lang="php">
    <![CDATA[public static Arr::sortBy(array &$array, callable $callback, bool $preserve_keys = false):true]]>
</code-block>













### ### Sorts an array by values using a user-defined comparison function



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L2033">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L2033">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code><![CDATA[ callable (TValue $a, TValue $b):int<-1, 1> ]]></code>
The comparison function must return an integer less than, equal to, or greater than zero if the first argument
is considered to be respectively less than, equal to, or greater than the second.
</format></li><li>bool <format style="bold">$preserve_keys</format> = false - <format style="italic">[optional] 
Whether you want to preserve keys from an original array or not.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>true - <format style="italic">Always true.</format></li></list>
    </def>
</deflist>
## method: sortKeyBy {id="sortkeyby()"}

<code-block lang="php">
    <![CDATA[public static Arr::sortKeyBy(array &$array, callable $callback):true]]>
</code-block>













### ### Sorts array by key using a user-defined comparison function



<deflist><def title="Source code:">
                <a href="https://github.com/The-FireHub-Project/Core/blob/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L2065">
                    View source code
                </a>
            </def>
            <def title="Blame:">
                <a href="https://github.com/The-FireHub-Project/Core/blame/develop-pre-alpha-m1/src/support/lowlevel/firehub.Arr.php#L2065">
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
        <list><li>TKey of array-key</li><li>TValue</li></list>
    </def>
</deflist>
<deflist>
    <def title="This method has parameters:">
        <list><li>by reference array <format style="bold">$array</format> - <format style="italic">
<code><![CDATA[ array<TKey, TValue> ]]></code>
Array to sort.
</format></li><li>callable <format style="bold">$callback</format> - <format style="italic">
<code><![CDATA[ callable (TKey $a, TKey $b):int<-1, 1> ]]></code>
The callback comparison function. Function cmp_function should accept two parameters which will be filled
by pairs of array keys. The comparison function must return an integer less than, equal to, or greater than
zero if the first argument is considered to be respectively less than, equal to, or greater than the second.
</format></li></list>
    </def>
</deflist>
<deflist>
    <def title="This method returns:">
        <list><li>true - <format style="italic">Always true.</format></li></list>
    </def>
</deflist>