<?php

namespace Bbsnly\ChartJs\Config;

/**
 * Wraps a raw JavaScript expression (e.g. a tooltip callback) so that
 * toJson() and toHtml() embed it verbatim instead of as a JSON string.
 *
 * The wrapped code is emitted into the page UNESCAPED: only ever wrap
 * code you wrote yourself, never user input.
 *
 * Output containing a JsExpression is a JavaScript object literal, not
 * strict JSON — it works inline (toHtml(), or
 * `new Chart(ctx, <?= $chart->toJson() ?>)`) but cannot be JSON.parse'd.
 * Outside toJson() — e.g. a plain json_encode() of a config — the
 * expression degrades to an ordinary JSON string, never raw code.
 *
 * The expression is injected verbatim, bypassing the JSON escaping that
 * protects data values: when embedding via toHtml() (an inline <script>
 * block), avoid the literal character sequence "</script>" anywhere in
 * the expression — including inside its string literals — as the HTML
 * parser would end the script block there.
 */
final class JsExpression implements \JsonSerializable
{
    /**
     * Nonce of the currently running toJson() capture, or null outside
     * one. Placeholders are tagged with it so attacker-supplied strings
     * cannot forge them.
     */
    private static ?string $nonce = null;

    public function __construct(private string $expression)
    {
    }

    public function expression(): string
    {
        return $this->expression;
    }

    public function jsonSerialize(): string
    {
        if (self::$nonce === null) {
            return $this->expression;
        }

        return self::$nonce . strtr(base64_encode($this->expression), '+/', '-_') . self::$nonce;
    }

    /**
     * Start a capture for one serialization and return its nonce.
     *
     * @internal
     */
    public static function beginCapture(): string
    {
        self::$nonce = '__jsexpr_' . bin2hex(random_bytes(8)) . '__';

        return self::$nonce;
    }

    /**
     * @internal
     */
    public static function endCapture(): void
    {
        self::$nonce = null;
    }

    /**
     * Replace the quoted placeholders tagged with $nonce by their raw
     * JavaScript expressions. Base64url payloads survive the JSON_HEX_*
     * flags untouched, so decoding is exact.
     *
     * @internal
     */
    public static function inject(string $json, string $nonce): string
    {
        if (!str_contains($json, $nonce)) {
            return $json;
        }

        $quoted = preg_quote($nonce, '/');

        $result = preg_replace_callback(
            '/"' . $quoted . '([A-Za-z0-9_=-]*)' . $quoted . '"/',
            static fn (array $matches): string => (string) base64_decode(strtr($matches[1], '-_', '+/'), true),
            $json
        );

        return $result ?? $json;
    }
}
