#!/usr/bin/env python3
"""Builds the printable ring sizer PDFs (A4 + US Letter) from inc/sizes.php.

Run from the theme root after changing ring sizes:
    python3 tools/printable_pdf.py
Needs php (CLI) and reportlab. Output: assets/printable/ring-sizer-a4.pdf, ring-sizer-letter.pdf
"""
import json
import math
import os
import subprocess

from reportlab.lib.colors import HexColor
from reportlab.lib.pagesizes import A4, LETTER
from reportlab.lib.units import mm
from reportlab.pdfgen import canvas

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
BLUE = HexColor('#1d4ed8')
GREY = HexColor('#6b7280')
LIGHT = HexColor('#e5e7eb')


def ring_rows():
    code = ("define('ABSPATH',1); include 'inc/sizes.php'; $o=array();"
            "foreach(rbs_ring_sizes() as $r){$d=rbs_ring_derived($r['mm']);"
            "$o[]=array('us'=>$r['us'],'uk'=>$r['uk'],'mm'=>$r['mm'],'eu'=>$d['eu'],'circ'=>$d['circ_mm']);}"
            "echo json_encode($o);")
    out = subprocess.check_output(['php', '-r', code], cwd=ROOT)
    return json.loads(out)


def fmt_us(v):
    return ('%g' % v)


def build(path, pagesize, label):
    rows = ring_rows()
    w, h = pagesize
    c = canvas.Canvas(path, pagesize=pagesize)
    c.setTitle('Printable Ring Sizer (%s) - ringbanglesizer.com' % label)
    c.setAuthor('Ring Bangle Sizer')
    c.setSubject('True-size ring size circles and finger sizing strip')
    left = 15 * mm
    top = h - 14 * mm

    # Header
    c.setFillColor(HexColor('#111827'))
    c.setFont('Helvetica-Bold', 16)
    c.drawString(left, top - 4 * mm, 'Printable Ring Sizer')
    c.setFont('Helvetica', 9)
    c.setFillColor(GREY)
    c.drawRightString(w - left, top - 4 * mm, 'ringbanglesizer.com  |  %s paper' % label)
    c.setFillColor(HexColor('#111827'))
    c.setFont('Helvetica', 9)
    c.drawString(left, top - 10 * mm, 'Print at 100% / "Actual size" (turn OFF "Fit to page"). Then check the scale below before you use it.')

    # Step 1: scale check
    y = top - 17 * mm
    c.setFont('Helvetica-Bold', 10)
    c.drawString(left, y, '1. Check the print scale')
    c.setFont('Helvetica', 8.5)
    c.drawString(left, y - 5 * mm, 'This line must measure exactly 50 mm (5 cm) on a ruler:')
    ly = y - 11 * mm
    c.setStrokeColor(HexColor('#111827'))
    c.setLineWidth(0.8)
    c.line(left, ly, left + 50 * mm, ly)
    for x in (0, 50):
        c.line(left + x * mm, ly - 2 * mm, left + x * mm, ly + 2 * mm)
    c.setLineWidth(0.3)
    for x in range(0, 51, 10):
        c.line(left + x * mm, ly - 1.2 * mm, left + x * mm, ly + 1.2 * mm)
        c.drawCentredString(left + x * mm, ly - 5 * mm, str(x))
    c.drawString(left, ly - 10 * mm, 'And a bank card or ID card must fit the box on the right exactly.')
    c.drawString(left, ly - 14 * mm, 'If it does not, the printer scaled the page: reprint at 100%.')
    # Card outline (ISO/IEC 7810 ID-1)
    cw, ch = 85.6 * mm, 53.98 * mm
    cx = w - left - cw
    cy = y - ch + 2 * mm
    c.setDash(3, 2)
    c.setLineWidth(0.6)
    c.roundRect(cx, cy, cw, ch, 3.18 * mm)
    c.setDash()
    c.setFont('Helvetica', 8)
    c.setFillColor(GREY)
    c.drawCentredString(cx + cw / 2, cy + ch / 2 + 2 * mm, 'Bank card / ID card')
    c.drawCentredString(cx + cw / 2, cy + ch / 2 - 2.5 * mm, '85.6 x 54 mm')
    c.setFillColor(HexColor('#111827'))

    # Step 2: ring circles
    y = cy - 8 * mm
    c.setFont('Helvetica-Bold', 10)
    c.drawString(left, y, '2. Match a ring you own')
    c.setFont('Helvetica', 8.5)
    c.drawString(left, y - 5 * mm, 'Lay a ring that fits on the circles. Your size is the circle that lines up with the INSIDE edge of the ring.')
    c.drawString(left, y - 9 * mm, 'Between two circles? Choose the larger one. Labels: US size, UK size, inner diameter in mm.')
    circles = [r for r in rows if 4 <= r['us'] <= 12.5]
    cols = 6
    cell_w = (w - 2 * left) / cols
    cell_h = 32 * mm
    gy = y - 13 * mm
    for i, r in enumerate(circles):
        col, row = i % cols, i // cols
        x0 = left + col * cell_w + cell_w / 2
        y0 = gy - row * cell_h - 12 * mm
        rad = r['mm'] / 2 * mm
        c.setStrokeColor(BLUE)
        c.setLineWidth(0.35)
        c.circle(x0, y0, rad)
        c.setStrokeColor(LIGHT)
        c.setLineWidth(0.2)
        c.line(x0 - 1.5 * mm, y0, x0 + 1.5 * mm, y0)
        c.line(x0, y0 - 1.5 * mm, x0, y0 + 1.5 * mm)
        c.setFillColor(HexColor('#111827'))
        c.setFont('Helvetica-Bold', 8)
        c.drawCentredString(x0, y0 - 14.6 * mm, 'US %s  |  UK %s' % (fmt_us(r['us']), r['uk']))
        c.setFont('Helvetica', 7)
        c.setFillColor(GREY)
        c.drawCentredString(x0, y0 - 17.6 * mm, '%.1f mm' % r['mm'])
    rows_used = int(math.ceil(len(circles) / float(cols)))

    # Step 3: finger strip
    y = gy - rows_used * cell_h - 9 * mm
    c.setFillColor(HexColor('#111827'))
    c.setFont('Helvetica-Bold', 10)
    c.drawString(left, y, '3. No ring? Use the finger strip')
    c.setFont('Helvetica', 8.5)
    c.drawString(left, y - 5 * mm, 'Cut out the strip, wrap it around the base of your finger (numbers outward), and read the US size where the')
    c.drawString(left, y - 9 * mm, 'end of the strip meets the scale. Snug, not tight; it must still slide over your knuckle.')
    sx, sh = left, 16 * mm
    sy = y - 30 * mm
    length = 80 * mm
    c.setDash(2, 2)
    c.setStrokeColor(GREY)
    c.setLineWidth(0.4)
    c.rect(sx, sy, length + 12 * mm, sh)
    c.setDash()
    c.setFont('Helvetica', 6)
    c.setFillColor(GREY)
    c.drawString(sx + length + 1.5 * mm, sy + sh / 2 - 1 * mm, 'cut')
    c.setStrokeColor(HexColor('#111827'))
    zero = sx + 3 * mm
    for m in range(0, 76):
        t = 1.6 if m % 5 else 3
        c.setLineWidth(0.25 if m % 5 else 0.4)
        c.line(zero + m * mm, sy, zero + m * mm, sy + t * mm)
        if m % 10 == 0:
            c.setFillColor(GREY)
            c.drawCentredString(zero + m * mm, sy + 4.2 * mm, str(m))
    c.setFillColor(GREY)
    c.drawString(zero + 1.5 * mm, sy + 7.5 * mm, 'mm')
    # US size ticks on the upper edge, where the strip end lands at circumference = size
    c.setFillColor(BLUE)
    c.setStrokeColor(BLUE)
    for r in rows:
        if r['us'] < 3 or r['us'] > 13:
            continue
        x = zero + r['circ'] * mm
        whole = float(r['us']).is_integer()
        c.setLineWidth(0.45 if whole else 0.25)
        c.line(x, sy + sh, x, sy + sh - (4 if whole else 2.4) * mm)
        if whole:
            # Alternate label heights: whole sizes are only 2.5 mm apart.
            low = int(r['us']) % 2 == 0
            c.setFont('Helvetica-Bold', 6)
            c.drawCentredString(x, sy + sh - (9.2 if low else 6.4) * mm, fmt_us(r['us']))
    c.setFont('Helvetica-Bold', 6)
    c.drawString(zero + 30 * mm, sy + sh - 6.4 * mm, 'US size')

    # Footer
    c.setFillColor(GREY)
    c.setFont('Helvetica', 7.5)
    c.drawString(left, 12 * mm, 'Tips: measure in the evening at room temperature; wide bands (6 mm+) need 1/4-1/2 size larger. Accuracy about +/- 1/2 size.')
    c.drawString(left, 8 * mm, 'Full chart and on-screen sizer: ringbanglesizer.com/ring-size-chart/  -  Free to print for personal use.')
    c.showPage()
    c.save()


if __name__ == '__main__':
    out = os.path.join(ROOT, 'assets', 'printable')
    os.makedirs(out, exist_ok=True)
    build(os.path.join(out, 'ring-sizer-a4.pdf'), A4, 'A4')
    build(os.path.join(out, 'ring-sizer-letter.pdf'), LETTER, 'US Letter')
    print('ok')
