import javax.swing.JFrame;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.SwingUtilities;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class MyFrame extends JFrame implements ActionListener {
    private final JLabel label = new JLabel("Event Dispatching Thread Sample");
    private final JButton button = new JButton("countUp");
    public MyFrame() {
        super("MyFrame");
        getContentPane().setLayout(new FlowLayout());
        getContentPane().add(label);
        getContentPane().add(button);
        button.addActionListener(this);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        pack();
        setVisible(true);
    }
    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == button) {
            countUp();
        }
    }
    private void countUp() {
        System.out.println(Thread.currentThread().getName() + ":countUp:BEGIN");

        // invokerThreadは指定時間sleepした後、SwingUtilities.invokeLaterを呼ぶ
        new Thread("invokerThread") {
            public void run() {
                System.out.println(Thread.currentThread().getName() + ":invokerThread:BEGIN");
                for (int i = 0; i < 10; i++) {
                    final String string = "" + i;
                    try {
                        // executorはイベント・ディスパッチング・スレッドから呼ばれる
                        final Runnable executor = new Runnable() {
                            public void run() {
                                System.out.println(Thread.currentThread().getName() + ":executor:BEGIN:string = " + string);
                                label.setText(string);
                                System.out.println(Thread.currentThread().getName() + ":executor:END");
                            }
                        };

                        // executorをイベント・ディスパッチング・スレッドに呼び出させる
                        SwingUtilities.invokeLater(executor);

                        Thread.sleep(1000);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }
                System.out.println(Thread.currentThread().getName() + ":invokerThread:END");
            }
        }.start();

        System.out.println(Thread.currentThread().getName() + ":countUp:END");
    }
}
