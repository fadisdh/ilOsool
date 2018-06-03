<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "هذا الحقل يجب أن يكون مقبول.",
	"active_url"       => "هذا الحقل يجب أن يكون على شكل رابط إلكتروني فعال",
	"after"            => "هذا الحقل يجب أن يكون تاريخ بعد :date.",
	"alpha"            => "هذا الحقل يجب أن يحتوي فقط على أحرف",
	"alpha_dash"       => "هذا الحقل يجب أن يحتوي فقط على أحرف, أرقام و خطوط فاصلة.",
	"alpha_num"        => "هذا الحقل يجب أن يحتوي فقط على أحرف و أرقام.",
	"array"            => "The :attribute must be an array.",
	"before"           => "The :attribute must be a date before :date.",
	"between"          => array(
		"numeric" => "هذا الحقل يجب أن يكون ما بين :min - :max.",
		"file"    => "هذا الحقل يجب أن يكون ما بين :min - :max كيلوبايت.",
		"string"  => "هذا الحقل يجب أن يكون ما بين :min - :max أحرف.",
		"array"   => "هذا الحقل يجب أن يكون ما بين :min - :max عنصر.",
	),
	"confirmed"        => "هذا الحقل لا يتطابق.",
	"date"             => "هذه القيمة ليست تاريخ صحيح.",
	"date_format"      => "هذا الحقل لا يتطابق مع :format.",
	"different"        => "The :attribute and :other must be different.",
	"digits"           => "هذا الحقل يجب أن يكون :digits خانات.",
	"digits_between"   => "هذا الحقل يجب أن يكون ما بين :min و :max خانات.",
	"email"            => "هذا الحقل يجب أن يكون على شكل عنوان إلكتروني.",
	"exists"           => "القيمة المختارة غير صحيحة.",
	"image"            => "هذا الحقل يجب أن تكون صورة.",
	"in"               => "القيمة المختارة غير صحيحة.",
	"integer"          => "هذا الحقل يجب أن يكون عدد صحيح.",
	"ip"               => "The :attribute must be a valid IP address.",
	"max"              => array(
		"numeric" => "هذا الحقل يجب أن لا يكون أكبر من :max.",
		"file"    => "هذا الحقل يجب أن لا يكون أكبر من :max كيلوبايت.",
		"string"  => "هذا الحقل يجب أن لا يكون أكبر من :max أحرف.",
		"array"   => "هذا الحقل يجب أن لا يحتوي أكثر من :max عنصر.",
	),
	"mimes"            => "هذا الحقل يجب أن يكون من نوع: :values.",
	"min"              => array(
		"numeric" => "هذا الحقل يجب أن يكون على الأقل :min.",
		"file"    => "هذا الحقل يجب أن يكون على الأقل :min كيلوبايت.",
		"string"  => "هذا الحقل يجب أن يكون على الأقل :min أحرف.",
		"array"   => "هذا الحقل يجب أن يحتوي على الأقل :min عنصر.",
	),
	"not_in"           => "هذا الحقل غير صحيح.",
	"numeric"          => "هذا الحقل يجب أن يكون رقم.",
	"regex"            => "هذا الحقل غير صحيح.",
	"required"         => "هذا الحقل إجباري.",
	"required_if"      => "The :attribute field is required when :other is :value.",
	"required_with"    => "The :attribute field is required when :values is present.",
	"required_without" => "The :attribute field is required when :values is not present.",
	"same"             => "The :attribute and :other must match.",
	"size"             => array(
		"numeric" => "هذا الحقل يجب أن يكون :size.",
		"file"    => "هذا الحقل يجب أن يكون :size كيلوبايت.",
		"string"  => "هذا الحقل يجب أن يكون:size أحرف.",
		"array"   => "هذا الحقل يجب أن يحتوي :size عنصر.",
	),
	"unique"           => "هذا الحقل مأخوذ.",
	"url"              => "هذا الحقل يجب أن يكون على شكل رابط إلكتروني.",
	"alpha_numeric_spaces"     => "هذا الحقل يجب أن يحتوي أحرف, أرقام و فراغات بين الأحرف.",
	"alpha_spaces"     => "هذا الحقل يجب أن يحتوي فقط على أحرف و فراغات.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'correct_value'	=> 'الرجاء إدخال قيمة صحيحة',
		'empty'			=> 'الرجاء كتابة بعض المحتوى'
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
