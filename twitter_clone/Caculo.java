package Pacote;

import java.util.Scanner;

public class Calculo {
	public static void main(String[] args) {
		int linha = 36;
		int coluna = 4;
		double medias= 0;
		double maiorMedia = 0;
		int c = 0;
		String nomes[] = new String[linha];
		double notas[][] = new double[linha][coluna];
		Scanner s = new Scanner(System.in);

		;
		for (int i = 0; i < linha; i++) {
			System.out.println("Digite o nome");
			nomes[i] = s.next();
			for (int j = 0; j < coluna; j++) {

				if (j == 3) {
					notas[i][3] = ((notas[i][0]+(notas[i][0]*0.02)) + (notas[i][0]+(notas[i][1]*0.03)) + (notas[i][0]+(notas[i][2]*0.05))) / 3;
				} else {
					System.out.println("Digite a nota " + (j + 1));
					notas[i][j] = s.nextDouble();
				}
			}
		}
		for (int i = 0; i < linha; i++) {
			System.out.print("Nome: " + nomes[i] +"|");
			for (int j = 0; j < coluna; j++) {
				if (j == 3) {
					System.out.println(" Média: " + notas[i][j]+"|");
					medias+= notas[i][j];
					if(maiorMedia< notas[i][j]) {
						maiorMedia = notas[i][j];
						c = i;
					}
				} else {
					System.out.print(" Nota" + (j + 1) + ": " + notas[i][j]+"|");
				}
			}
		}
		double mediaTurma = medias/linha;
		System.out.println("A média da turma é:" +mediaTurma);
		System.out.println("A maior média é do aluno: " + nomes[c] + " E sua média é: " +maiorMedia );
		
	}

}
