# Upgrade guide

## v4 to v5

v5 modernizes the package for Chart.js 3/4 and fixes several long-standing
behavioral bugs. Most code keeps working unchanged; the full list of breaking
changes is below.

### Chart.js 2 is no longer supported

- `Chart::beginAtZero()` now emits the Chart.js 3+ scale syntax
  (`options.scales.y.beginAtZero`) instead of the v2-only
  `options.scales.yAxes[0].ticks.beginAtZero`. It also merges into any
  existing `scales` configuration instead of replacing it.
- If you are still on Chart.js 2, stay on v4 of this package.

### `toHtml()` changes

- The second parameter is now `bool $uniqueId = true` (disable the random id
  suffix); the previous, undocumented `?Chart $chart` parameter is gone. To
  render another chart instance, call `toHtml()` on that instance.
- Element names are validated: they must match `[A-Za-z][A-Za-z0-9_-]*`, and
  anything else throws an `InvalidArgumentException`. Previously such names
  were escaped into markup that silently failed to render.
- Cleanup now listens to `pagehide` instead of the deprecated `unload` event,
  and charts survive back/forward-cache restores.

### Serialization shape

- A chart whose `type` was never set omits `"type"` from `toArray()`/`toJson()`
  output entirely (previously `"type": null`).
- In `toJson()`, empty `data` and `options` encode as JSON objects (`{}`)
  instead of arrays (`[]`), matching the config shape Chart.js expects. This
  applies to `toJson()`/`jsonSerialize()` only: `toArray()` and `get()` are
  PHP-facing and still return `[]` for empty configs, so
  `json_encode($chart->get())` is *not* equivalent to `$chart->toJson()` —
  always use `toJson()` (or `json_encode($chart)`) when feeding Chart.js.
- Reading a config property that was never set no longer leaks a `"key": null`
  entry into the output. Explicitly assigned nulls are still kept — with one
  edge case: a null written through a reference taken *before* the property
  was ever assigned (`$ref = &$config->key; ...; $ref = null;`) bypasses
  `__set` and is treated as never-set, so it is dropped too.
- `ChartInterface` and `ConfigInterface` now extend `\JsonSerializable`. If
  you implement either interface yourself, add a `jsonSerialize()` method.
  A shared `ConfigInterface::JSON_FLAGS` constant holds the encoding flags.

### Config behavior fixes

- `toArray()` no longer mutates the object: nested `Dataset`/`Config` objects
  stay objects, so changes made after a serialization are still reflected in
  later serializations.
- `isset()`, `empty()`, and `unset()` now work correctly on magic config
  properties (`__isset`/`__unset` are implemented).
- Calling a magic option setter with anything other than exactly one argument
  throws an `ArgumentCountError`. Previously `$options->responsive()` silently
  assigned `false`, and extra arguments were silently discarded.
- Cloning now isolates state: `clone $chart` clones its `Data` and `Options`,
  and cloning any config object detaches it from references created by
  earlier property reads. Previously clones could share state with the
  original.

### Non-breaking changes worth knowing

- `composer test` and `composer analyse` scripts now exist.
- PHPStan runs at `level: max` in CI.
- PHP 8.1 through 8.5 are tested in CI.
