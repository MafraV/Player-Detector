import csv

dataset1 = csv.reader(open('C:/episodes/Players/player15.csv', 'r'), delimiter=",", quotechar='|')
dataset2 = csv.reader(open('C:/episodes/Players/player15.csv', 'r'), delimiter=",", quotechar='|')

x = [row[1] for row in dataset1]
y = [row[2] for row in dataset2]

tam = len(x)

x1 = []
y1 = []

for i in range(1,tam,20):
    x01 = float(x[i])
    y01 = float(y[i])
    x01 = float("{:.3f}".format(x01))
    y01 = float("{:.3f}".format(y01))
    x1.append(x01)
    y1.append(y01)

with open('C:/episodes/Players Melhorados/player15-final.csv', 'w', newline='') as file:
    writer = csv.writer(file)
    writer.writerow(["X", "Y"])
    tam = len(x1)
    for i in range(0,tam):
        writer.writerow([x1[i], y1[i]])     

print("done")
