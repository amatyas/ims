<div class="CSSTableGenerator">
    <table>
        <thead>
            <tr> 
                <?php foreach ($array[0] as $item): ?>
                    <td><?php echo $item; ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i < count($array); $i++): ?>
                <tr>
                    <?php foreach ($array[$i] as $item): ?>
                        <td><?php echo $item; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>        
        </tbody>
    </table>
</div>