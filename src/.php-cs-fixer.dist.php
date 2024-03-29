<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database/factories',
        __DIR__ . '/database/seeders',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

$config = new PhpCsFixer\Config();

// https://mlocati.github.io/php-cs-fixer-configurator/#version:3.8
return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2'                   => true,
        'align_multiline_comment' => true,
        'array_syntax'            => ['syntax' => 'short'],
        'binary_operator_spaces'  => [
            'operators' => ['=>' => 'align'],
        ],
        'blank_line_after_opening_tag' => true,
        'linebreak_after_opening_tag'  => true,
        'declare_strict_types'         => true,
        'phpdoc_types_order'           => [
            'null_adjustment' => 'always_last',
            'sort_algorithm'  => 'none',
        ],
        'no_superfluous_phpdoc_tags'  => false,
        'blank_line_after_namespace'  => true,
        'blank_line_before_statement' => ['statements' => ['return', 'throw', 'try']],
        'cast_spaces'                 => true,
        'class_attributes_separation' => [
            'elements' => [
                'const'        => 'one',
                'method'       => 'one',
                'property'     => 'one',
                'trait_import' => 'none',
            ],
        ],
        'declare_equal_normalize' => true,
        'function_typehint_space' => true,
        'braces'                  => true,
        'class_definition'        => true,
        'elseif'                  => true,
        'encoding'                => true,
        'function_declaration'    => true,
        'indentation_type'        => true,
        'full_opening_tag'        => true,
        'heredoc_to_nowdoc'       => true,
        'include'                 => true,
        'increment_style'         => ['style' => 'post'],
        'lowercase_cast'          => true,
        'magic_constant_casing'   => true,
        'method_argument_space' => [
            'keep_multiple_spaces_after_comma' => false,
            'after_heredoc' => true,
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'multiline_whitespace_before_semicolons'      => true,
        'native_function_casing'                      => true,
        'no_alias_functions'                          => true,
        'no_blank_lines_after_class_opening'          => true,
        'no_empty_phpdoc'                             => true,
        'no_empty_statement'                          => true,
        'no_extra_blank_lines'                        => ['tokens' => ['extra', 'use', 'use_trait']],
        'no_leading_import_slash'                     => true,
        'no_leading_namespace_whitespace'             => true,
        'no_mixed_echo_print'                         => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_short_bool_cast'                          => true,
        'no_singleline_whitespace_before_semicolons'  => true,
        'no_spaces_around_offset'                     => ['positions' => ['inside']],
        'no_spaces_after_function_name'               => true,
        'no_spaces_inside_parenthesis'                => true,
        'no_trailing_comma_in_list_call'              => true,
        'no_trailing_comma_in_singleline_array'       => true,
        'no_trailing_whitespace'                      => true,
        'no_trailing_whitespace_in_comment'           => true,
        'no_unneeded_control_parentheses'             => true,
        'no_unreachable_default_argument_value'       => true,
        'no_useless_return'                           => true,
        'no_unused_imports'                           => true,
        'no_whitespace_before_comma_in_array'         => true,
        'no_whitespace_in_blank_line'                 => true,
        'normalize_index_brace'                       => true,
        'not_operator_with_successor_space'           => true,
        'object_operator_without_whitespace'          => true,
        'ordered_class_elements'                      => ['order' => ['use_trait', 'constant_public', 'constant_protected', 'constant_private', 'property_public', 'property_protected', 'property_private', 'construct', 'destruct', 'magic', 'phpunit', 'method_public', 'method_protected', 'method_private'], 'sort_algorithm' => 'none'],
        'ordered_imports'                             => ['sort_algorithm' => 'alpha'],
        'phpdoc_indent'                               => true,
        'phpdoc_inline_tag_normalizer'                => true,
        'phpdoc_no_access'                            => true,
        'phpdoc_no_useless_inheritdoc'                => true,
        'phpdoc_no_empty_return'                      => false,
        'phpdoc_scalar'                               => true,
        'phpdoc_single_line_var_spacing'              => true,
        'phpdoc_to_comment'                           => false, // アノテーションが無効化されてしまうのでfalse
        'phpdoc_order'                                => true,
        'phpdoc_trim'                                 => true,
        'phpdoc_types'                                => true,
        'phpdoc_var_without_name'                     => true,
        'phpdoc_align'                                => [
            'align' => 'vertical',
        ],
        'short_scalar_cast'                           => true,
        'single_blank_line_before_namespace'          => true,
        'single_line_comment_style'                   => ['comment_types' => ['hash']],
        'single_line_after_imports'                   => true,
        'single_import_per_statement'                 => true,
        'single_quote'                                => true,
        'space_after_semicolon'                       => true,
        'standardize_not_equals'                      => true,
        'ternary_operator_spaces'                     => true,
        'trim_array_spaces'                           => true,
        'unary_operator_spaces'                       => true,
        'visibility_required'                         => true,
        'yoda_style'                                  => false,
        'whitespace_after_comma_in_array'             => true,
    ])
    ->setUsingCache(false)
    ->setFinder($finder);
