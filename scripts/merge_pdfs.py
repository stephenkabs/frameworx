
import sys
from PyPDF2 import PdfMerger

def merge_pdfs(input_files, output_file):
    merger = PdfMerger()
    for pdf in input_files:
        merger.append(pdf)
    merger.write(output_file)
    merger.close()

if __name__ == "__main__":
    if len(sys.argv) < 4:
        print("Usage: python merge_pdfs.py <pdf1> <pdf2> ... <output_pdf>")
        sys.exit(1)

    input_files = sys.argv[1:-1]  # All input PDFs except the last one
    output_file = sys.argv[-1]    # The last argument is the output file
    merge_pdfs(input_files, output_file)
