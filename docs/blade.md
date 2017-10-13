# Blade
It is also possible to use the Blade Directive and generate the chart canvas
```blade
@chartjs('element_id', $chart)
```

The output is
```html
<canvas id="element_id"></canvas>
<script>
    new Chart(
        document.getElementById("element_id").getContext("2d"),
        obj
    );
</script>
```
